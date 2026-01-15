<script setup lang="ts">
import { Chart, PieController, BarController, ArcElement, BarElement, CategoryScale, LinearScale, Tooltip, Legend } from 'chart.js'
import ChartDataLabels from 'chartjs-plugin-datalabels'
import { onMounted, ref } from 'vue'
import AppLayout from '@/layouts/AppLayout.vue'
import MainButton from '@/components/MainButton.vue'
import jsPDF from 'jspdf'

Chart.register(
  PieController, BarController,
  ArcElement, BarElement,
  CategoryScale, LinearScale,
  Tooltip, Legend,
  ChartDataLabels
)

const props = defineProps<{
  perSpecialitate: Array<{ label: string, value: number }>
  boliCronice: Array<{ label: string, value: number }>
}>()

const specialitateRef = ref<HTMLDivElement | null>(null)
const boliRef = ref<HTMLDivElement | null>(null)

let pieSpecialitateChart: Chart | null = null
let barSpecialitateChart: Chart | null = null
let pieBoliChart: Chart | null = null
let barBoliChart: Chart | null = null

onMounted(() => {
  renderCharts()
})

function renderCharts() {
// Pie Specialitati 
    pieSpecialitateChart = new Chart(document.getElementById('pieSpecialitate') as HTMLCanvasElement, {
    type: 'pie',
    data: {
        labels: props.perSpecialitate.map(e => e.label),
        datasets: [{
        data: props.perSpecialitate.map(e => e.value),
        backgroundColor: ['#3b82f6','#f59e0b','#10b981','#ef4444','#8b5cf6','#f43f5e']
        }]
    },
    plugins: [ChartDataLabels],
    options: {
        plugins: {
        datalabels: {
            color: '#fff',
            formatter: (value, context) => {
            const data = context.chart.data.datasets[0].data as number[]
            const total = data.reduce((sum, val) => sum + val, 0)
            const percent = total ? (value / total * 100).toFixed(1) : '0'
            return `${percent}%`
            },
            font: { weight: 'bold', size: 14 }
        },
        legend: { position: 'bottom' }
        },
        responsive: true
    }
})

  //  Bar Specialitati
  barSpecialitateChart = new Chart(document.getElementById('barSpecialitate') as HTMLCanvasElement, {
    type: 'bar',
    data: {
      labels: props.perSpecialitate.map(e => e.label),
      datasets: [{
        label: 'Pacienti',
        data: props.perSpecialitate.map(e => e.value),
        backgroundColor: '#3b82f6'
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { display: false } },
      scales: { y: { beginAtZero: true } }
    }
  })

  //  Pie Boli Cronice
  pieBoliChart = new Chart(document.getElementById('pieBoli') as HTMLCanvasElement, {
    type: 'pie',
    data: {
      labels: props.boliCronice.map(e => e.label),
      datasets: [{
        data: props.boliCronice.map(e => e.value),
        backgroundColor: ['#f59e0b','#10b981','#ef4444','#8b5cf6']
      }]
    },
    plugins: [ChartDataLabels],
    options: {
      plugins: {
        datalabels: {
          color: '#fff',
          formatter: (value, context) => {
            const data = context.chart.data.datasets[0].data as number[]
            const total = data.reduce((sum, val) => sum + val, 0)
            const percent = total ? (value / total * 100).toFixed(1) : '0'
            return `${percent}%`
          },
          font: { weight: 'bold', size: 14 }
        },
        legend: { position: 'bottom' }
      },
      responsive: true
    }
  })

  // Bar Boli Cronice 
  barBoliChart = new Chart(document.getElementById('barBoli') as HTMLCanvasElement, {
    type: 'bar',
    data: {
      labels: props.boliCronice.map(e => e.label),
      datasets: [{
        label: 'Pacienti',
        data: props.boliCronice.map(e => e.value),
        backgroundColor: '#10b981'
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { display: false } },
      scales: { y: { beginAtZero: true } }
    }
  })
}

// Functie generica PDF pentru orice canvas
function genereazaPDFFromChart(chart: Chart, filename: string) {
  const imgData = chart.toBase64Image()
  const pdf = new jsPDF('landscape', 'mm', 'a4')
  const pdfWidth = pdf.internal.pageSize.getWidth()
  const pdfHeight = pdf.internal.pageSize.getHeight()
  pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight)
  pdf.save(filename)
}
</script>

<template>
    <AppLayout>
    <div class="grid grid-cols-2 gap-6 ml-[15px] mb-[30px] mt-[30px] mr-[15px]">
        <div class="flex flex-col border border-black bg-white" ref="specialitateRef">
            <div class="p-[9px] flex justify-between items-center">
                <h3 class="font-semibold mb-[5px] pl-[7px] pb-[8px] pt-[7px] border-b-1 border-[#E3E7EF] !text-[#205BA4]">Pacienti pe specialitati</h3>
                <MainButton @click="pieSpecialitateChart && genereazaPDFFromChart(pieSpecialitateChart, 'pacienti_specialitati.pdf')">Genereaza PDF</MainButton>
            </div>
            <canvas id="pieSpecialitate"></canvas>
            <canvas id="barSpecialitate"></canvas>
        </div>

        <div class="flex flex-col border border-black bg-white" ref="boliRef">
            <div class="p-[9px] flex justify-between items-center">
                <h3 class="font-semibold mb-[5px] pl-[7px] pb-[8px] pt-[7px] border-b-1 border-[#E3E7EF] !text-[#205BA4]">Boli cronice</h3>
                <MainButton @click="pieBoliChart && genereazaPDFFromChart(pieBoliChart, 'boli_cronice.pdf')">Genereaza PDF</MainButton>
            </div>
            <canvas id="pieBoli"></canvas>
            <canvas id="barBoli"></canvas>
        </div>
    </div>
    </AppLayout>
</template>
