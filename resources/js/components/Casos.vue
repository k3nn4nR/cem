<template>
    <v-card>
        <v-card-text>
            <v-card-text>
                <v-data-table :headers="CasosHeaders" :items="casos" :search="busqueda">
                    <template v-slot:top>
                        <v-toolbar flat>
                            <v-toolbar-title>Personas</v-toolbar-title>
                            <v-divider class="mx-4" inset vertical/>
                            <v-spacer/>
                            <v-text-field v-model="busqueda" label="Busqueda" />
                            <v-divider class="mx-4" inset vertical/>
                            <v-spacer/>
                            <v-dialog v-model="dialog" max-width="700px" persistent>
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn color="success" dark class="mb-2" v-bind="attrs" v-on="on" >
                                        +
                                    </v-btn>
                                </template>
                                <v-card>
                                    <v-card-title><span class="text-h5">{{ formTitle }}</span></v-card-title>
                                    <v-card-text>
                                        <v-row>
                                            <v-col>
                                                 <v-text-field lable="Ficha" v-model="editedCaso.ficha" />
                                            </v-col>
                                            <v-col>
                                                 <v-text-field lable="Fecha" v-model="editedCaso.fecha_caso" />
                                            </v-col>
                                        </v-row>
                                        <v-row>
                                            <v-col>
                                                <v-text-field lable="Lugar" v-model="editedCaso.lugar" />
                                            </v-col>
                                            <v-col>
                                                <v-text-field lable="Tipo" v-model="editedCaso.tipo" />
                                            </v-col>
                                        </v-row>
                                        <v-row>
                                            <v-col>
                                                <v-text-field lable="Medida" v-model="editedCaso.medida" />
                                            </v-col>
                                            <v-col>
                                                <v-text-field lable="Observacion Abogado" v-model="editedCaso.observacion_abogado" />
                                            </v-col>
                                        </v-row>
                                        <v-row>
                                            <v-col>
                                                <v-select :items="personas" label="Denunciante" item-value="dni" v-model="editedCaso.denunciante_dni">
                                                    <template slot="selection" slot-scope="data">
                                                        {{ data.item.ape_paterno+" "+data.item.ape_materno+" "+data.item.nombres }}
                                                    </template>
                                                    <template slot="item" slot-scope="data">
                                                        {{ data.item.ape_paterno+" "+data.item.ape_materno+" "+data.item.nombres }}
                                                    </template>
                                                </v-select>
                                            </v-col>
                                        </v-row>
                                    </v-card-text>
                                    <v-card-actions>
                                        <v-btn class="error" @click="close">Cancelar</v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>
                        </v-toolbar>
                    </template>
                </v-data-table>
            </v-card-text>
        </v-card-text>
    </v-card>
</template>
<script>
export default {
    data(){
        return {
            dialog:false,
            busqueda:'',
            casos:[],
            personas:[],
            editedIndex:-1,
            editedCaso:{
                ficha:'',
                denunciante_dni:'',
                fecha_caso:'',
                tipo:'',
                lugar:'',
                medida:'',
                observacion_abogado:'',
            },
            defaultCaso:{
                ficha:'',
                denunciante_dni:'',
                fecha_caso:'',
                tipo:'',
                lugar:'',
                medida:'',
                observacion_abogado:'',
            },
        };
    },
    computed:{
        CasosHeaders(){
            return [
                {text:'Ficha',value:'ficha'},
                {text:'Registrado',value:'fecha_caso'},
                {text:'Denunciante',value:'denunciante_dni'},
            ];
        },
        formTitle () {
            return this.editedIndex === -1 ? 'Nueva Persona' : 'Editar Persona'
        },
    },
    mounted(){
        this.getData()
    },
    methods:{
        getData(){
            axios.get('caso').then(response=>{this.casos=response.data})
            axios.get('persona').then(response=>{this.personas = response.data})
        },
        close () {
            this.dialog = false
            this.$nextTick(() => {
                this.editedCaso = Object.assign({}, this.defaultCaso)
                this.editedIndex = -1
            })
        },
    }
}
</script>