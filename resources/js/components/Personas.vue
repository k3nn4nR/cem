<template>
    <v-card outlined>
        <v-card-text>
            <v-data-table :headers="PersonasHeaders" :items="personas" :search="busqueda" dense>
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
                                <template>
                                    <v-card>
                                        <v-toolbar flat color="primary" dark >
                                            <v-toolbar-title>{{ editedPersona.ape_paterno }} {{ editedPersona.ape_materno }} {{ editedPersona.nombres }}</v-toolbar-title>
                                        </v-toolbar>
                                        <v-tabs vertical>
                                            <v-tab>
                                                <v-icon left>
                                                    mdi-account
                                                </v-icon>
                                                Editar
                                            </v-tab>
                                            <v-tab v-if="formTitle =='Editar Persona'">
                                                <v-icon left>
                                                    mdi-account-group
                                                </v-icon>
                                                Contactos
                                            </v-tab>
                                            <v-tab v-if="formTitle =='Editar Persona'">
                                                <v-icon left>
                                                    mdi-access-point
                                                </v-icon>
                                                Ubicaciones
                                            </v-tab>
                                            <v-tab-item>
                                                <v-card flat>
                                                    <v-card-title><span class="text-h5">{{ formTitle }}</span></v-card-title>
                                                    <v-card-text>
                                                        <v-row>
                                                            <v-col>
                                                                <v-text-field v-model="editedPersona.dni" label="DNI" />
                                                            </v-col>
                                                            <v-col>
                                                                <v-text-field v-model="editedPersona.nombres" label="Nombres" />
                                                            </v-col>
                                                        </v-row>
                                                        <v-row>
                                                                <v-col>
                                                                <v-text-field v-model="editedPersona.ape_paterno" label="Apellido Paterno" />
                                                            </v-col>
                                                                <v-col>
                                                                <v-text-field v-model="editedPersona.ape_materno" label="Apellido Materno" />
                                                            </v-col>
                                                        </v-row>
                                                        <v-row>
                                                            <v-col>
                                                                <v-text-field v-model="editedPersona.celular" label="Celular" />
                                                            </v-col>
                                                            <v-col>
                                                                <v-text-field v-model="editedPersona.edad" label="Edad" />
                                                            </v-col>
                                                            <v-col>
                                                                <v-select v-model="editedPersona.nivel_riesgo" label="Nivel de Riesgo" :items='NivelesDeRiesgo' />
                                                            </v-col>
                                                        </v-row>
                                                    </v-card-text>
                                                    <v-card-actions>
                                                        <v-btn class="success" @click="save">Guardar</v-btn>
                                                        <v-btn class="error" @click="close">Cancelar</v-btn>
                                                    </v-card-actions>
                                                </v-card>
                                            </v-tab-item>
                                            <v-tab-item>
                                                <v-card flat>
                                                    <v-card-text>
                                                        <Contactos v-on:delete="close" :persona="editedPersona.dni"/>
                                                    </v-card-text>
                                                    </v-card>
                                            </v-tab-item>
                                            <v-tab-item>
                                                <v-card flat>
                                                    <v-card-text>
                                                        <Ubicaciones v-on:delete="close" :persona="editedPersona.dni"/>
                                                    </v-card-text>
                                                </v-card>
                                            </v-tab-item>
                                        </v-tabs>
                                    </v-card>
                                </template>
                            </v-card>
                        </v-dialog>
                    </v-toolbar>
                </template>

                <template v-slot:item.acciones="{ item }">
                    <v-icon small class="mr-2" @click="editItem(item)" >
                        mdi-pencil
                    </v-icon>
                </template>    
            </v-data-table>
        </v-card-text>
    </v-card>
</template>

<script>
    import Contactos from  './Contactos.vue';
    import Ubicaciones from './Ubicaciones.vue';
    export default {
        components:{
            Contactos,
            Ubicaciones,
        },
        data(){
            return {
                busqueda:'',
                personas:[],
                dialog:false,
                editedIndex: -1,
                editedPersona:{
                    dni: '',
                    ape_paterno: '',
                    ape_materno: '',
                    nombres: '',
                    celular: '',
                    edad: 0,
                    nivel_riesgo: '',
                },
                defaultPersona:{
                    dni: '',
                    ape_paterno: '',
                    ape_materno: '',
                    nombres: '',
                    celular: '',
                    edad: 0,
                    nivel_riesgo: '',
                },
            };
        },
        computed:{
            formTitle () {
                return this.editedIndex === -1 ? 'Nueva Persona' : 'Editar Persona'
            },
            PersonasHeaders(){
                return [
                    {text: 'DNI',value: 'dni'},
                    {text: 'Paterno',value: 'ape_paterno'},
                    {text: 'Materno',value: 'ape_materno'},
                    {text: 'Nombres',value: 'nombres'},
                    {text: 'Celular',value: 'celular'},
                    {text: 'Riesgo',value: 'nivel_riesgo'},
                    {text: ' ',value: 'acciones'},
                ];
            },
            NivelesDeRiesgo(){
                return [
                    {text: 'LEVE',value: 'LEVE'},
                    {text: 'MODERADO',value: 'MODERADO'},
                    {text: 'SEVERO',value: 'SEVERO'},
                ];
            }
        },
        watch: {
            dialog (val) {
                val || this.close()
            },
            dialogDelete (val) {
                val || this.closeDelete()
            },
        },
        created () {
            this.getData()
        },
        methods:{
            getData(){
                axios.get('persona').then(response=>{this.personas = response.data})
            },
            editItem (item) {
                this.editedIndex = this.personas.indexOf(item)
                this.editedPersona = Object.assign({}, item)
                this.dni = this.editedPersona.dni
                this.dialog = true
            },
            save () {
                if (this.editedIndex > -1) {
                    axios.put('persona',{dni_original:this.dni,persona:this.editedPersona}).then(response=>{
                        this.getData()
                        this.close()
                        Swal.fire({
                            icon:'success',
                            text:'Actualizacion Satisfactoria!',
                        })
                    }).catch(error =>{
                        this.showError(error.response.data.errors)
                    })
                } 
                if(this.editedIndex == -1) {
                    axios.post('persona',{persona:this.editedPersona}).then(response=>{
                        this.getData()
                        this.close()
                        Swal.fire({
                            icon:'success',
                            text:'Registro Satisfactorio!',
                        })
                    }).catch(error =>{
                        this.showError(error.response.data.errors)
                    })
                }
            },
            close () {
                this.dialog = false
                this.$nextTick(() => {
                    this.editedPersona = Object.assign({}, this.defaultPersona)
                    this.editedIndex = -1
                })
                this.dni = ''
            },
            showError(errores){
                var texto="";
                for (var property in errores){
                    texto = texto + errores[property]+'\n';
                }
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
                Toast.fire({
                    icon: 'warning',
                    title : texto
                })
            },
        }
    }
</script>
