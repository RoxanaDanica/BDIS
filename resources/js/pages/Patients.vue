<script setup lang="ts">
import { ref, computed, watch } from 'vue'
import { useToast } from 'primevue/usetoast'
import { router } from '@inertiajs/vue3'
import MainButton from '@/components/MainButton.vue'
import DeleteButton from '@/components/DeleteButton.vue'
import PatientsSearch from '@/components/PatientsSearch.vue'
import AppLayout from '@/layouts/AppLayout.vue';
import Toast from 'primevue/toast';
import { Head } from '@inertiajs/vue3'

import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import Dialog from 'primevue/dialog'
import InputText from 'primevue/inputtext'
import Textarea from 'primevue/textarea'
import InputNumber from 'primevue/inputnumber'
import Button from 'primevue/button'

const props = defineProps<{ pacienti: Array<any> }>()
const pacientiLocal = ref([...props.pacienti])

const pacientDialog = ref(false)
const submitted = ref(false)
const search = ref('')
const confirmDialogVisible = ref(false)
const pacientDeSters = ref(null)


const pacient = ref({
    cnp: '',
    nume: '',
    prenume: '',
    dataNasterii: '',
    varsta: 0,
    adresa: '',
    email: '',
    telefon: ''
})

const toast = useToast()

const columns = [
    { field: 'cnp', header: 'CNP' },
    { field: 'nume', header: 'Nume' },
    { field: 'prenume', header: 'Prenume' },
    { field: 'telefon', header: 'Telefon' }
]

const filteredPacienti = computed(() => {
    if (!search.value) return pacientiLocal.value
    const term = search.value.toLowerCase()
    return pacientiLocal.value.filter(p =>
        p.nume.toLowerCase().includes(term) || p.prenume.toLowerCase().includes(term)
    )
})

const formFields = [
    { label: 'CNP', model: 'cnp', type: InputText, required: true, validation: val => /^[0-9]{13}$/.test(val), errorMsg: 'CNP-ul trebuie să aibă 13 cifre' },
    { label: 'Nume', model: 'nume', type: InputText, required: true },
    { label: 'Prenume', model: 'prenume', type: InputText, required: true },
    { label: 'Data nașterii', model: 'dataNasterii', type: InputText, required: true, inputType: 'date' },
    { label: 'Vârstă', model: 'varsta', type: InputNumber, required: false },
    { label: 'Adresă', model: 'adresa', type: Textarea, required: true, rows: 3 },
    { label: 'Email', model: 'email', type: InputText, required: true, validation: val => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val), errorMsg: 'Email invalid' },
    { label: 'Telefon', model: 'telefon', type: InputText, required: true, validation: val => /^[0-9]{10}$/.test(val), errorMsg: 'Telefon invalid' }
]


const calculeazaVarsta = (dataNasterii: string) => {
  if (!dataNasterii) return 0

  const azi = new Date()
  const dataNasc = new Date(dataNasterii)
  let varsta = azi.getFullYear() - dataNasc.getFullYear()
  const lunaDif = azi.getMonth() - dataNasc.getMonth()
  const ziDif = azi.getDate() - dataNasc.getDate()

  if (lunaDif < 0 || (lunaDif === 0 && ziDif < 0)) {
    varsta--
  }

  return varsta
}

watch(() => pacient.value.dataNasterii, (newVal) => {
    pacient.value.varsta = calculeazaVarsta(newVal)
})

const editeazaPacient = (row = null) => { 
    if (row) pacient.value = { ...row }
    else pacient.value = { cnp: '', nume: '', prenume: '', dataNasterii: '', varsta: 0, adresa: '', email: '', telefon: '' }
    pacientDialog.value = true
}

const hideDialog = () => {
    pacientDialog.value = false
    submitted.value = false
}

const salveazaPacient = () => {
    submitted.value = true
    if (!pacient.value.cnp || !pacient.value.nume || !pacient.value.prenume) return

    const index = pacientiLocal.value.findIndex(p => p.cnp === pacient.value.cnp)

    if (index !== -1) {
        router.put(`/pacienti/${pacient.value.cnp}`, pacient.value, {
            onSuccess: () => {
                pacientiLocal.value[index] = { ...pacient.value }
                pacientDialog.value = false
                toast.add({ severity: 'success', summary: 'Succes', detail: 'Pacient actualizat' })
            }
        })
    } else {
        router.post('/pacienti', pacient.value, {
            onSuccess: () => {
                pacientiLocal.value.push({ ...pacient.value })
                pacientDialog.value = false
                toast.add({ severity: 'success', summary: 'Succes', detail: 'Pacient adăugat' })
            }
        })
    }   
}


const stergePacient = (row) => {
    pacientDeSters.value = row
    confirmDialogVisible.value = true
}


const confirmaStergere = () => {
    if (!pacientDeSters.value) return

    router.delete(`/pacienti/${pacientDeSters.value.cnp}`, {
        onSuccess: () => {
            pacientiLocal.value = pacientiLocal.value.filter(
                p => p.cnp !== pacientDeSters.value!.cnp 
            )

            pacientDeSters.value = null
            confirmDialogVisible.value = false

            toast.add({ severity: 'success', summary: 'Șters', detail: 'Pacient șters' })
        }
    })
}
 


const anuleazaStergere = () => {
    confirmDialogVisible.value = false
    pacientDeSters.value = null
}

</script>


<template>
    <AppLayout>
        <Head>
            <title>Gestionare pacienti</title>
            <meta name="description" content="Your page description">
        </Head>
        <div class="p-[15px] flex gap-[5px] items-center border-b border-[#b3b3b3]">
            <PatientsSearch v-model="search"/>
            <MainButton @click="editeazaPacient">Adauga pacient</MainButton>
        </div>

        <DataTable :key="pacientiLocal.length" :value="filteredPacienti" stripedRows tableStyle="min-width: 50rem" class="p-[15px]">
            <Column v-for="col of columns" :key="col.field" :field="col.field" :header="col.header"/>
            <Column :exportable="false" header="Options" style="min-width: 12rem">
            <template #body="slotProps">
                <MainButton icon="pi pi-pencil" variant="outlined" rounded class="mr-2" @click="editeazaPacient(slotProps.data)">Edit</MainButton>
                <DeleteButton icon="pi pi-trash" variant="outlined" rounded severity="danger" @click="stergePacient(slotProps.data)">Delete</DeleteButton>
            </template>
            </Column>
        </DataTable>

        <Dialog v-model:visible="pacientDialog" :style="{ width: '500px' }" modal header="">
            <div v-for="field in formFields" :key="field.model" class="mb-4">
            <label :for="field.model" class="block font-bold mb-2">{{ field.label }}</label>
            <component 
                :is="field.type" 
                v-model="pacient[field.model]" 
                :invalid="submitted && field.required && !pacient[field.model]"
                :type="field.inputType"
                :rows="field.rows"
                fluid
            />
            <small v-if="submitted && field.required && !pacient[field.model]" class="text-red-500">
                {{ field.label }} este obligatoriu.
            </small>
            <small v-else-if="field.validation && submitted && pacient[field.model] && !field.validation(pacient[field.model])" class="text-red-500">
                {{ field.errorMsg }}
            </small>
            </div>

            <template #footer>
            <Button label="Cancel" icon="pi pi-times" text @click="hideDialog"/>
            <Button label="Save" icon="pi pi-check" @click="salveazaPacient"/>
            </template>
        </Dialog> 
        
        <Dialog v-model:visible="confirmDialogVisible" header="Confirmare ștergere" modal :closable="false" :style="{ width: '400px' }">    
            <p>Sigur doriți să ștergeți pacientul <strong>{{ pacientDeSters?.nume }} {{ pacientDeSters?.prenume }}</strong>?</p>
            <template #footer>
                <Button label="Nu" icon="pi pi-times" text @click="anuleazaStergere"/>
                <Button label="Da" icon="pi pi-check" severity="danger" @click="confirmaStergere"/>
            </template>
        </Dialog>
        <Toast position="bottom-right"/>
    </AppLayout>
</template>
 