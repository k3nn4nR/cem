<template>
    <v-card flat>
        <v-card-text>
            <v-data-table :headers="DireccionesHeaders" :items="direcciones">
                <template v-slot:top>
                    <v-toolbar flat>
                        <v-toolbar-title>Ubicaciones</v-toolbar-title>
                        <v-divider class="mx-4" inset vertical/>
                        <v-spacer/>
                        <v-dialog v-model="dialog" max-width="700px" persistent>
                            <template v-slot:activator="{ on, attrs }">
                                <v-btn color="success" dark class="mb-2" v-bind="attrs" v-on="on" >
                                    +
                                </v-btn>
                            </template>
                            <v-card flat>
                                <v-card-title><span class="text-h5">{{ formTitle }}</span></v-card-title>
                                <v-card-text>
                                    <v-row>
                                        <v-col>
                                            <v-text-field v-model="editedUbicacion.direccion" label="Direccion" />
                                        </v-col>
                                        <v-col>
                                            <v-text-field v-model="editedUbicacion.referencia" label="Referencia" />
                                        </v-col>
                                    </v-row>
                                </v-card-text>
                                <v-card-actions>
                                    <v-btn class="success" @click="save">Guardar</v-btn>
                                    <v-btn class="error" @click="closeDialog">Cancelar</v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </v-toolbar>
                </template>
            </v-data-table>
        </v-card-text>
        <v-card-actions>
            <v-btn class="error" @click="close">Cancelar</v-btn>
        </v-card-actions>
    </v-card>
</template>
<script>
export default {
    props:['persona'],
    data(){
        return {
            dialog:false,
            direcciones:[],
            editedUbicacion:{
                id: '',
                persona_dni: '',
                direccion: '',
                referencia: '',
            },
            defaultUbicacion:{
                id: '',
                persona_dni: '',
                direccion: '',
                referencia: '',
            },
            editedIndex: -1,
        };
    },
    computed:{
         formTitle () {
            return this.editedIndex === -1 ? 'Nueva Ubicacion' : 'Editar Ubicacion'
        },
        DireccionesHeaders(){
            return [
                {text:'Direccion',value:'direccion'},
                {text:'Referencia',value:'referencia'},
                {text: ' ',value: 'acciones'},
            ];
        }
    },
    watch: {
        dialog (val) {
            val || this.closeDialog()
        },
        dialogDelete (val) {
            val || this.closeDelete()
        },
        persona (val){
            if(val != ""){
                this.getData()
            }
        },
    },
    mounted(){
        this.getData()
    },
    methods:{
        getData(){
            axios.get('persona-ubicaciones/'+this.persona).then(response=>{this.direcciones=response.data})
            axios.get('persona-casos/'+this.persona).then(response=>{this.direcciones=response.data})
        },
        close(){
            this.$emit('delete');
        },
        closeDialog () {
            this.dialog = false
            this.$nextTick(() => {
                this.editedUbicacion = Object.assign({}, this.defaultUbicacion)
                this.editedIndex = -1
            })
        },
        save () {
            if (this.editedIndex > -1) {
                axios.put('ubicacion',{ubicacion:this.editedUbicacion}).then(response=>{this.getData()}).catch(error =>{
                    this.showError(error.response.data.errors)
                })
            } 
            if(this.editedIndex == -1) {
                this.editedUbicacion.persona_dni = this.persona
                axios.post('ubicacion',{ubicacion:this.editedUbicacion}).then(response=>{this.getData()}).catch(error =>{
                    this.showError(error.response.data.errors)
                })
            }
            this.closeDialog()
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
                onOpen: (toast) => {
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