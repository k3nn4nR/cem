<template>
    <v-card>
        <v-card-text>
            <v-row>
                <v-col>
                    <v-select :items="departamentos" v-model="departamentoSelected" label="Departamento" item-value="id" item-text="descripcion"/>
                </v-col>
                <v-col>
                    <v-select :items="provincias" v-model="provinciaSelected" label="Provincia" item-value="id" item-text="descripcion"/>
                </v-col>
                <v-col> 
                    <v-select :items="distritos" v-model="distritoSelected" label="Distrito" item-value="id" item-text="descripcion"/>
                </v-col>
            </v-row>
        </v-card-text>
    </v-card>
</template>
<script>
    export default {
        data(){
            return {
                departamentos:[],
                provincias:[],
                distritos:[],
                departamentoSelected:'',
                distritoSelected:'',
                provinciaSelected:'',
            };
        },
        watch:{
            departamentoSelected(val){
                if(val != ''){
                    this.provinciaSelected = ''
                    this.distritoSelected = ''
                    axios.get('departamento/'+val).then(response=>{this.provincias=response.data})
                }
            },
            provinciaSelected(val){
                if(val != ''){
                    this.distritoSelected = ''
                    axios.get('provincia/'+val).then(response=>{this.distritos=response.data})
                }
            }
        },
        mounted(){
            this.getDepartamentos()
        },
        methods:{
            getDepartamentos(){
                axios.get('departamento').then(response=>{this.departamentos=response.data})
            }
        }
    }
</script>