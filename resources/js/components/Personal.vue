<template>
    <v-layout wrap>
        <v-flex xs12>
            <v-card outlined>
                <v-card-title>

                </v-card-title>
                <v-card-text>
                    <v-row>
                        <v-col>
                            <v-data-table dense :items="personales" :headers="PersonalesHeaders" :search="busqueda">
                                <template v-slot:top>
                                    <v-toolbar flat>
                                        <v-toolbar-title>Personales</v-toolbar-title>
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
                                                            <v-text-field v-model="editPersonal.id" label="ID" demse />
                                                        </v-col>
                                                        <v-col>
                                                            <v-text-field v-model="editPersonal.cargo" label="Cargo" demse />
                                                        </v-col>
                                                    </v-row>
                                                    <v-row>
                                                        <v-col>
                                                             <v-select dense :items="personas" label="Persona" item-value="dni" v-model="editPersonal.persona_dni">
                                                                <template slot="selection" slot-scope="data">
                                                                    {{ data.item.dni+" "+data.item.ape_paterno+" "+data.item.ape_materno+" "+data.item.nombres }}
                                                                </template>
                                                                <template slot="item" slot-scope="data">
                                                                    {{ data.item.dni+" "+data.item.ape_paterno+" "+data.item.ape_materno+" "+data.item.nombres }}
                                                                </template>
                                                            </v-select>
                                                        </v-col>
                                                    </v-row>
                                                </v-card-text>
                                                <v-card-actions>
                                                    <v-btn class="success" @click="save">Guardar</v-btn>
                                                    <v-btn class="error" @click="close">Cancelar</v-btn>
                                                </v-card-actions>
                                            </v-card>
                                        </v-dialog>
                                    </v-toolbar>
                                </template>
                                <template v-slot:item.acciones="{ item }">
                                    <v-icon small class="mr-2" @click="editItem(item)" >
                                        mdi-pencil
                                    </v-icon>
                                     <v-icon small class="mr-2" @click="deleteItem(item)" >
                                        mdi-delete
                                    </v-icon>
                                </template>    
                            </v-data-table>
                        </v-col>
                    </v-row>
                </v-card-text>
            </v-card>
        </v-flex>
    </v-layout>
</template>
<script>
    export default {
        data(){
            return {
                dialog:false,
                busqueda:'',
                personales:[],
                personas:[],
                editPersonal:{
                    id:'',
                    persona_dni:'',
                    cargo:''
                },
                defaultPersonal:{
                    id:'',
                    persona_dni:'',
                    cargo:''
                },
                editedIndex: -1,
            };
        },
        computed:{
            formTitle () {
                return this.editedIndex === -1 ? 'Nuevo Personal' : 'Editar Personal'
            },
            PersonalesHeaders(){
                return [
                    {text:'ID',value:'id'},
                    {text:'Cargo',value:'cargo'},
                    {text:'Apellido Paterno',value:'persona.ape_paterno'},
                    {text:'Apellido Materno',value:'persona.ape_materno'},
                    {text:'Nombre',value:'persona.nombres'},
                    {text: ' ',value: 'acciones'},
                ];
            }
        },
        mounted(){
            this.getData()
        },
        methods:{
            getData(){
                axios.get('personal').then(response=>{this.personales=response.data})
                axios.get('persona').then(response=>{this.personas=response.data})
            },
            close () {
                this.dialog = false
                this.$nextTick(() => {
                    this.editPersonal = Object.assign({}, this.defaultPersonal)
                    this.editedIndex = -1
                })
            },
            save(){
                if (this.editedIndex > -1) {
                    axios.put('personal',{personal:this.editPersonal}).then(response=>{
                        this.close()
                        this.getData()
                        Swal.fire({
                            icon:'success',
                            text:'Actualizacion Satisfactoria!',
                        })
                    }).catch(error =>{
                        this.showError(error.response.data.errors)
                    })
                } 
                if(this.editedIndex == -1) {
                    axios.post('personal',{personal:this.editPersonal}).then(response=>{
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
            editItem (item) {
                this.editedIndex = this.personas.indexOf(item)
                this.editPersonal = Object.assign({}, item)
                this.dialog = true
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
            deleteItem(item){
                Swal.fire({
                    title: 'Eliminacion!',
                    text: "Desea eliminar "+item.id,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Elminiar!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/trabajador/'+item.id).then(response => {
                            Swal.fire(
                                'eliminado!',
                                'El personal fue eliminado.',
                                'success'
                            )
                        }).catch(error =>{
                            this.showError(error.response.data.errors)
                        });
                    }
                })
            },
        }
    }
</script>