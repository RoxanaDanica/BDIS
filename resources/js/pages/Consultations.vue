<script setup lang="ts">
import { ref, computed, watch } from 'vue'
import { useToast } from 'primevue/usetoast'
import { router } from '@inertiajs/vue3'
import MainButton from '@/components/MainButton.vue'
import DeleteButton from '@/components/DeleteButton.vue'
import AppLayout from '@/layouts/AppLayout.vue';
import Toast from 'primevue/toast';
import { Head } from '@inertiajs/vue3'

import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import Dialog from 'primevue/dialog'
import InputText from 'primevue/inputtext'
import Textarea from 'primevue/textarea'
import Calendar from 'primevue/calendar'
import Button from 'primevue/button'

const props = defineProps<{ consultatii: Array<any>, pacienti: Array<any>, doctori: Array<any> }>()
const consultatiiLocal = ref([...props.consultatii])

const consultatieDialog = ref(false)
const submitted = ref(false)
const search = ref('')
const confirmDialogVisible = ref(false)
const consultatieDeSters = ref(null)

// Model formular
const consultatie = ref({
  id: null,
  cnp_pacient: '',
  pacient_nume: '',
  pacient_prenume: '',
  cnp_doctor: '',
  doctor_nume: '',
  doctor_prenume: '',
  doctor_specialitate: '',
  data_consultatiei: null,
  diagnostic: '',
  medicamentatie: ''
})

const toast = useToast()

watch(() => consultatie.value.cnp_doctor, (newCnp) => {
  const doctor = props.doctori.find(d => d.cnp_doctor === newCnp)
  if (doctor) {
    consultatie.value.doctor_nume = doctor.nume
    consultatie.value.doctor_prenume = doctor.prenume
    consultatie.value.doctor_specialitate = doctor.specialitate?.nume ?? ''
  } else {
    consultatie.value.doctor_nume = ''
    consultatie.value.doctor_prenume = ''
    consultatie.value.doctor_specialitate = ''
  }
})


// Filtrare după pacient, doctor sau specialitate
const filteredConsultatii = computed(() => {
  if (!search.value) return consultatiiLocal.value
  const term = search.value.toLowerCase()
  return consultatiiLocal.value.filter(c =>
    (`${c.pacient_nume} ${c.pacient_prenume}`).toLowerCase().includes(term) ||
    (`${c.doctor_nume} ${c.doctor_prenume}`).toLowerCase().includes(term) ||
    (c.doctor_specialitate?.toLowerCase().includes(term))
  )
})

// CRUD
const editeazaConsultatie = (row = null) => {
  if (row) {
    consultatie.value = {
      ...row,
      data_consultatiei: row.data_consultatiei ? new Date(row.data_consultatiei) : null,
      doctor_specialitate: row.doctor_specialitate ?? ''
    }
  } else {
    consultatie.value = { 
      id: null, 
      cnp_pacient: '', pacient_nume: '', pacient_prenume: '',
      cnp_doctor: '', doctor_nume: '', doctor_prenume: '', doctor_specialitate: '',
      data_consultatiei: null, diagnostic: '', medicamentatie: '' 
    }
  }
  consultatieDialog.value = true
}

const hideDialog = () => {
  consultatieDialog.value = false
  submitted.value = false
}

const salveazaConsultatie = () => {
  submitted.value = true
  if (!consultatie.value.cnp_pacient || !consultatie.value.cnp_doctor || !consultatie.value.data_consultatiei) return

  const payload = {
    cnp_pacient: consultatie.value.cnp_pacient,
    cnp_doctor: consultatie.value.cnp_doctor,
    data_consultatiei: consultatie.value.data_consultatiei.toISOString().split('T')[0],
    diagnostic: consultatie.value.diagnostic,
    medicamentatie: consultatie.value.medicamentatie ?? '',
  }

  if (consultatie.value.id) {
    const index = consultatiiLocal.value.findIndex(c => c.id === consultatie.value.id)
    router.put(`/consultatii/${consultatie.value.id}`, payload, {
      onSuccess: () => {
        consultatiiLocal.value[index] = { ...consultatie.value }
        consultatieDialog.value = false
        toast.add({ severity: 'success', summary: 'Succes', detail: 'Consultatie actualizata' })
      }
    })
  } else {
    router.post('/consultatii', payload, {
    onSuccess: (page) => {
        const newConsultatie = page.props.consultatie
        consultatiiLocal.value.push(newConsultatie)
        consultatieDialog.value = false
        toast.add({ severity: 'success', summary: 'Succes', detail: 'Consultatie adaugata' })
    }
    }) 

  }
}

const stergeConsultatie = (row) => {
  consultatieDeSters.value = row
  confirmDialogVisible.value = true
}

const confirmaStergere = () => {
    if (!consultatieDeSters.value) return

    router.delete(`/consultatii/${consultatieDeSters.value.id}`, {
        onSuccess: () => {
            consultatiiLocal.value = consultatiiLocal.value.filter(c => c.id !== consultatieDeSters.value.id)
            toast.add({ severity: 'success', summary: 'Șters', detail: 'Consultatie stearsa' })
        }
    })

    confirmDialogVisible.value = false
    consultatieDeSters.value = null
}

const anuleazaStergere = () => {
    confirmDialogVisible.value = false
    consultatieDeSters.value = null
}
</script>

<template>
    <AppLayout>
        <Head>
            <title>Gestionare consultatii</title>
            <meta name="description" content="Pagina de consultatii">
        </Head>

        <div class="p-[15px] flex gap-[5px] items-center border-b border-[#b3b3b3]">
            <InputText v-model="search" placeholder="Cauta consultatii"/>
            <MainButton @click="editeazaConsultatie">Adauga consultatie</MainButton>
        </div>

        <DataTable :value="filteredConsultatii" stripedRows tableStyle="min-width: 50rem" class="p-[15px]">
            <Column header="Pacient">
            <template #body="slotProps">{{ slotProps.data.pacient_nume }} {{ slotProps.data.pacient_prenume }}</template>
            </Column>
            <Column header="Doctor">
            <template #body="slotProps">{{ slotProps.data.doctor_nume }} {{ slotProps.data.doctor_prenume }}</template>
            </Column>
            <Column header="Specialitate">
            <template #body="slotProps">{{ slotProps.data.doctor_specialitate }}</template>
            </Column>
            <Column field="data_consultatiei" header="Data consultatiei"/>
            <Column field="diagnostic" header="Diagnostic"/>
            <Column :exportable="false" header="Options" style="min-width: 12rem">
            <template #body="slotProps">
                <MainButton icon="pi pi-pencil" variant="outlined" rounded class="mr-2" @click="editeazaConsultatie(slotProps.data)">Edit</MainButton>
                <DeleteButton icon="pi pi-trash" variant="outlined" rounded severity="danger" @click="stergeConsultatie(slotProps.data)">Delete</DeleteButton>
            </template>
            </Column>
        </DataTable>

        <Dialog v-model:visible="consultatieDialog" :style="{ width: '500px' }" modal header="">
            <!-- Pacient -->
            <div class="mb-4">
            <label class="block font-bold mb-2">Pacient</label>
            <template v-if="consultatie.id">
                <InputText :value="consultatie.pacient_nume + ' ' + consultatie.pacient_prenume" disabled class="w-full border rounded p-2" />
            </template>
            <template v-else>
                <select v-model="consultatie.cnp_pacient" class="w-full border rounded p-2">
                <option value="">Selecteaza Pacient</option>
                <option v-for="p in props.pacienti" :key="p.cnp" :value="p.cnp">{{ p.nume }} {{ p.prenume }}</option>
                </select>
            </template>
            </div>

            <!-- Doctor -->
            <div class="mb-4">
            <label class="block font-bold mb-2">Doctor</label>
            <template v-if="consultatie.id">
                <InputText :value="consultatie.doctor_nume + ' ' + consultatie.doctor_prenume" disabled class="w-full border rounded p-2" />
            </template>
            <template v-else>
                <select v-model="consultatie.cnp_doctor" class="w-full border rounded p-2">
                <option value="">Selecteaza Doctor</option>
                <option v-for="d in props.doctori" :key="d.cnp_doctor" :value="d.cnp_doctor">
                    {{ d.nume }} {{ d.prenume }} ({{ d.specialitate?.nume ?? 'N/A' }})
                </option>

                </select>
            </template>
            </div>

            <!-- Specialitate -->
            <div class="mb-4">
            <label class="block font-bold mb-2">Specialitate</label>
            <InputText v-model="consultatie.doctor_specialitate" class="w-full border rounded p-2" :disabled="consultatie.id"/>
            </div>

            <div class="mb-4">
            <label class="block font-bold mb-2">Data consultatiei</label>
            <Calendar v-model="consultatie.data_consultatiei" :showIcon="true" class="w-full" />
            </div>
            <div class="mb-4">
            <label class="block font-bold mb-2">Diagnostic</label>
            <Textarea v-model="consultatie.diagnostic" rows="3" class="w-full"/>
            </div>
            <div class="mb-4">
            <label class="block font-bold mb-2">Medicamentatie</label>
            <Textarea v-model="consultatie.medicamentatie" rows="3" class="w-full"/>
            </div>

            <template #footer>
            <Button label="Cancel" icon="pi pi-times" text @click="hideDialog"/>
            <Button label="Save" icon="pi pi-check" @click="salveazaConsultatie"/>
            </template>
        </Dialog>

        <Dialog v-model:visible="confirmDialogVisible" header="Confirmare ștergere" modal :closable="false" :style="{ width: '400px' }">
            <p>Sigur doriți să ștergeți consultatia?</p>
            <template #footer>
            <Button label="Nu" icon="pi pi-times" text @click="anuleazaStergere"/>
            <Button label="Da" icon="pi pi-check" severity="danger" @click="confirmaStergere"/>
            </template>
        </Dialog>
        <Toast position="bottom-right"/>
    </AppLayout>
</template>
