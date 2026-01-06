<script setup lang="ts">
import MainButton from '@/components/MainButton.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

import { Users, ClipboardList, Stethoscope, ChartNoAxesCombined, ChartColumnIncreasing } from 'lucide-vue-next';
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];

const pacienti = [
  {
    cnp: "1960523123456",
    nume: "Popescu",
    prenume: "Andrei",
    data_nasterii: "1996-05-23",
    varsta: 28,
    adresa: "Str. Lalelelor nr. 10, Bucuresti",
    email: "andrei.popescu@gmail.com",
    telefon: "0723456789"
  },
  {
    cnp: "1980615123456",
    nume: "Ionescu",
    prenume: "Maria",
    data_nasterii: "1998-06-15",
    varsta: 26,
    adresa: "Str. Libertatii nr. 22, Cluj",
    email: "maria.ionescu@yahoo.com",
    telefon: "0744123456"
  },
  {
    cnp: "1951109123456",
    nume: "Dumitru",
    prenume: "Ion",
    data_nasterii: "1955-11-09",
    varsta: 69,
    adresa: "Str. Viitorului nr. 5, Iasi",
    email: "ion.dumitru@gmail.com",
    telefon: "0733987654"
  },
  {
    cnp: "2000101123456",
    nume: "Georgescu",
    prenume: "Raluca",
    data_nasterii: "2000-01-01",
    varsta: 25,
    adresa: "Str. Pacii nr. 44, Brasov",
    email: "raluca.geo@gmail.com",
    telefon: "0765123987"
  },
  {
    cnp: "1970823123456",
    nume: "Radu",
    prenume: "Daniel",
    data_nasterii: "1977-08-23",
    varsta: 47,
    adresa: "Str. Stadionului nr. 9, Craiova",
    email: "daniel.radu@gmail.com",
    telefon: "0722998877"
  },
  {
    cnp: "1991212123456",
    nume: "Matei",
    prenume: "Laura",
    data_nasterii: "1999-12-12",
    varsta: 25,
    adresa: "Str. Primaverii nr. 3, Sibiu",
    email: "laura.matei@gmail.com",
    telefon: "0755332211"
  },
  {
    cnp: "1960303123456",
    nume: "Stoica",
    prenume: "Mihnea",
    data_nasterii: "1966-03-03",
    varsta: 58,
    adresa: "Str. Castanilor nr. 14, Pitesti",
    email: "mihnea.stoica@yahoo.com",
    telefon: "0746001122"
  },
  {
    cnp: "1980418123456",
    nume: "Neagu",
    prenume: "Bogdan",
    data_nasterii: "1988-04-18",
    varsta: 36,
    adresa: "Str. Orhideelor nr. 8, Targoviste",
    email: "bogdan.neagu@gmail.com",
    telefon: "0733112233"
  },
  {
    cnp: "1970911123456",
    nume: "Barbu",
    prenume: "Alina",
    data_nasterii: "1977-09-11",
    varsta: 47,
    adresa: "Str. Nordului nr. 1, Constanta",
    email: "alina.barbu@gmail.com",
    telefon: "0724556677"
  },
  {
    cnp: "2000222123456",
    nume: "Lazar",
    prenume: "Stefan",
    data_nasterii: "2000-02-22",
    varsta: 24,
    adresa: "Str. Morii nr. 19, Arad",
    email: "stefan.lazar@gmail.com",
    telefon: "0788990011"
  },
  {
    cnp: "1961225123456",
    nume: "Enache",
    prenume: "Vasile",
    data_nasterii: "1966-12-25",
    varsta: 58,
    adresa: "Str. Dunarii nr. 6, Galati",
    email: "vasile.enache@gmail.com",
    telefon: "0721445566"
  },
  {
    cnp: "1990707123456",
    nume: "Toma",
    prenume: "Irina",
    data_nasterii: "1999-07-07",
    varsta: 25,
    adresa: "Str. Soarelui nr. 11, Deva",
    email: "irina.toma@gmail.com",
    telefon: "0759003344"
  }
];
const consultatii = [
  {
    nr_consultatie: 1,
    cnp_pacient: "1960523123456",
    cnp_doctor: "1700101123456",
    data_consultatiei: "2024-03-10",
    diagnostic: "Hipertensiune",
    medicatie: "Ramipril"
  },
  {
    nr_consultatie: 2,
    cnp_pacient: "1980615123456",
    cnp_doctor: "2680222123456",
    data_consultatiei: "2024-02-20",
    diagnostic: "Diabet tip 2",
    medicatie: "Metformin"
  },
  {
    nr_consultatie: 3,
    cnp_pacient: "1951109123456",
    cnp_doctor: "1650315123456",
    data_consultatiei: "2024-01-18",
    diagnostic: "Astm bronsic",
    medicatie: "Ventolin"
  },
  {
    nr_consultatie: 4,
    cnp_pacient: "2000101123456",
    cnp_doctor: "1800404123456",
    data_consultatiei: "2024-04-01",
    diagnostic: "Gastrita",
    medicatie: "Omeprazol"
  },
  {
    nr_consultatie: 5,
    cnp_pacient: "1970823123456",
    cnp_doctor: "1750707123456",
    data_consultatiei: "2024-03-30",
    diagnostic: "Psoriazis",
    medicatie: "Dermovate"
  },
  {
    nr_consultatie: 6,
    cnp_pacient: "1991212123456",
    cnp_doctor: "1680505123456",
    data_consultatiei: "2024-02-10",
    diagnostic: "Migrena",
    medicatie: "Sumatriptan"
  },
  {
    nr_consultatie: 7,
    cnp_pacient: "1960303123456",
    cnp_doctor: "1720202123456",
    data_consultatiei: "2024-01-05",
    diagnostic: "Glaucom",
    medicatie: "Timolol"
  },
  {
    nr_consultatie: 8,
    cnp_pacient: "1980418123456",
    cnp_doctor: "1780606123456",
    data_consultatiei: "2024-03-12",
    diagnostic: "Sinuzita",
    medicatie: "Augmentin"
  },
  {
    nr_consultatie: 9,
    cnp_pacient: "1970911123456",
    cnp_doctor: "1600101123456",
    data_consultatiei: "2024-04-02",
    diagnostic: "Cancer mamar",
    medicatie: "Chimioterapie"
  },
  {
    nr_consultatie: 10,
    cnp_pacient: "2000222123456",
    cnp_doctor: "1750707123456",
    data_consultatiei: "2024-01-25",
    diagnostic: "Dermatita",
    medicatie: "Bepanthen"
  },
  {
    nr_consultatie: 11,
    cnp_pacient: "1961225123456",
    cnp_doctor: "2680222123456",
    data_consultatiei: "2024-02-14",
    diagnostic: "Diabet tip 2",
    medicatie: "Insulina"
  },
  {
    nr_consultatie: 12,
    cnp_pacient: "1990707123456",
    cnp_doctor: "1700101123456",
    data_consultatiei: "2024-03-05",
    diagnostic: "Hipertensiune",
    medicatie: "Amlodipina"
  }
];
const doctori = [
  {
    cnp_doctor: "1700101123456",
    nume: "Ionescu",
    prenume: "Mihai",
    email: "mihai.ionescu@clinica.ro",
    parola: "parola123",
    specialitate: "Cardiologie"
  },
  {
    cnp_doctor: "2680222123456",
    nume: "Popa",
    prenume: "Elena",
    email: "elena.popa@clinica.ro",
    parola: "parola123",
    specialitate: "Diabet si Nutritie"
  },
  {
    cnp_doctor: "1650315123456",
    nume: "Stan",
    prenume: "Cristina",
    email: "cristina.stan@clinica.ro",
    parola: "parola123",
    specialitate: "Pneumologie"
  },
  {
    cnp_doctor: "1800404123456",
    nume: "Marin",
    prenume: "Alexandru",
    email: "alex.marin@clinica.ro",
    parola: "parola123",
    specialitate: "Gastroenterologie"
  },
  {
    cnp_doctor: "1750707123456",
    nume: "Vasilescu",
    prenume: "Ana",
    email: "ana.vasilescu@clinica.ro",
    parola: "parola123",
    specialitate: "Dermato-venerologie"
  },
  {
    cnp_doctor: "1680505123456",
    nume: "Petrescu",
    prenume: "Radu",
    email: "radu.petrescu@clinica.ro",
    parola: "parola123",
    specialitate: "Neurologie"
  },
  {
    cnp_doctor: "1720202123456",
    nume: "Ilie",
    prenume: "Diana",
    email: "diana.ilie@clinica.ro",
    parola: "parola123",
    specialitate: "Oftalmologie"
  },
  {
    cnp_doctor: "1780606123456",
    nume: "Grigore",
    prenume: "Ioana",
    email: "ioana.grigore@clinica.ro",
    parola: "parola123",
    specialitate: "O.R.L"
  },
  {
    cnp_doctor: "1600101123456",
    nume: "Dobre",
    prenume: "Florin",
    email: "florin.dobre@clinica.ro",
    parola: "parola123",
    specialitate: "Oncologie"
  }
];



</script>

<template>
    <Head title="Acasa" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
        >
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div class="relative aspect-video overflow-hidden rounded-md flex flex-col justify-center bg-[#448DCF] items-center">
                    <h3 class="!text-white text-lg font-medium pb-[8px]">Pacienți</h3>
                    <Users width="45" height="45"/>
                    <p class="!text-white font-medium pt-[8px]">{{ pacienti.length }}</p>   
                </div>
                <div class="relative aspect-video overflow-hidden rounded-md flex flex-col justify-center bg-[#205BA4] items-center">
                    <h3 class="!text-white text-lg font-medium pb-[8px]">Consultatii</h3>
                    <ClipboardList  width="45" height="45"/>
                    <p  class="!text-white pt-[8px] font-medium">{{ consultatii.length }}</p>
                </div>
                <div class="relative aspect-video overflow-hidden rounded-md flex flex-col justify-center bg-[#205BA4] items-center">
                    <h3 class="!text-white text-lg font-medium pb-[8px]">Rapoarte</h3>
                    <Stethoscope  width="45" height="45"/>
                    <p  class="!text-white pt-[8px] font-medium">{{ consultatii.length }}</p>
                </div>
            </div>
            <div class="grid auto-rows-min gap-4 md:grid-cols-2">
                <div class="relative aspect-video overflow-hidden rounded-md flex flex-col justify-center bg-[#FEFEFE] items-center">
                    <div class="flex gap-[5px] items-center p-[15px] pb-[30px] w-[80%] border-b-1 border-[#E3E7EF] mb-[30px]">
                        <ChartColumnIncreasing stroke="#205BA4"  width="45" height="45"/>
                        <h3 class="text-lg font-medium !text-[#205BA4]">Pacienți</h3>
                    </div>  
                    <MainButton>Vezi Statistici</MainButton> 
                </div>
                <div class="relative aspect-video overflow-hidden rounded-md flex flex-col justify-center bg-[#FEFEFE] items-center">
                    <div class="flex gap-[5px] items-center p-[15px] pb-[30px] w-[80%] border-b-1 border-[#E3E7EF] mb-[30px]">
                        <ChartNoAxesCombined stroke="#205BA4"  width="45" height="45"/>
                        <h3 class="text-lg font-medium !text-[#205BA4]">Consultatii</h3>
                    </div>
                    <MainButton>Vezi Statistici</MainButton>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
