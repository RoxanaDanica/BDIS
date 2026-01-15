<script setup>
import MainButton from './MainButton.vue';
import InputText from 'primevue/inputtext';
import { ref, watch, defineProps, defineEmits } from 'vue';

const props = defineProps({
    modelValue: {
      type: String,
      default: ''
    },
});

const emit = defineEmits(['update:modelValue', 'search'])
const localValue = ref(props.modelValue)
watch(localValue, (val) => {
  emit('update:modelValue', val)
})

watch(() => props.modelValue, (val) => {
  if (val !== localValue.value) {
    localValue.value = val
  }
})

const triggerSearch = () => {
  emit('search', localValue.value)
}
</script>

<template>
  <form class="flex items-center gap-[20px]" @submit.prevent="triggerSearch">
    <label for="search">Caută pacient:</label>
    <div class="flex gap-[5px]">
      <InputText
        id="search"
        v-model="localValue"
        type="text"
        placeholder="Nume"
      />
      <MainButton @click="triggerSearch" type="button">Caută</MainButton>
    </div>
  </form>
</template>
