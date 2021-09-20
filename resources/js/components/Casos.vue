<template>
    <v-layout wrap>
        <v-flex xs12>
            <v-card outlined>
                <v-card-text>
                    <v-card-text>
                        <v-data-table dense :headers="CasosHeaders" :items="casos" :search="busqueda">
                            <template v-slot:top>
                                <v-toolbar flat>
                                    <v-toolbar-title>Casos</v-toolbar-title>
                                    <v-divider class="mx-4" inset vertical/>
                                    <v-spacer/>
                                    <v-text-field v-model="busqueda" label="Busqueda" />
                                    <v-divider class="mx-4" inset vertical/>
                                    <v-spacer/>
                                    <v-dialog v-model="dialog" max-width="800px" persistent>
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
                                                        <v-text-field dense label="Ficha" v-model="editedCaso.ficha" />
                                                    </v-col>
                                                    <v-col>
                                                        <v-menu v-model="menu" :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y min-width="auto" >
                                                            <template v-slot:activator="{ on, attrs }">
                                                                <v-text-field dense v-model="editedCaso.fecha_caso" label="Fecha del caso" prepend-icon="mdi-calendar" readonly v-bind="attrs" v-on="on"/>
                                                            </template>
                                                            <v-date-picker v-model="editedCaso.fecha_caso" @input="menu = false"/>
                                                        </v-menu>
                                                    </v-col>
                                                    <v-col>
                                                        <v-select :items="turnos" v-model="editedCaso.turno" dense label="Turno" />
                                                    </v-col>
                                                </v-row>
                                                <v-row>
                                                    <v-col>
                                                        <v-text-field dense label="Lugar" v-model="editedCaso.lugar" />
                                                    </v-col>
                                                    
                                                </v-row>
                                                <v-row>
                                                    <v-col>
                                                        <v-select :items="medidas" v-model="editedCaso.medida" dense label="Medida" />
                                                    </v-col>
                                                    <v-col>
                                                        <v-text-field dense label="Observacion Abogado" v-model="editedCaso.observacion_abogado" />
                                                    </v-col>
                                                </v-row>
                                                <v-row>
                                                    <v-col>
                                                        <v-select dense :items="personas" label="Denunciante" item-value="dni" v-model="editedCaso.denunciante_dni">
                                                            <template slot="selection" slot-scope="data">
                                                                {{ data.item.dni+" "+data.item.ape_paterno+" "+data.item.ape_materno+" "+data.item.nombres }}
                                                            </template>
                                                            <template slot="item" slot-scope="data">
                                                                {{ data.item.dni+" "+data.item.ape_paterno+" "+data.item.ape_materno+" "+data.item.nombres }}
                                                            </template>
                                                        </v-select>
                                                    </v-col>
                                                </v-row>
                                                <v-row>
                                                    <v-col>
                                                        <v-btn class="warning" @click="addDetalle" >Agregar Agresor</v-btn>
                                                    </v-col>
                                                </v-row>
                                                <v-card outlined v-for="(detalle,d) in detalles" :key="d">
                                                    <v-card-text>
                                                        <v-row>
                                                            <v-col>
                                                                <v-select dense :items="agresores" label="Agresor" item-value="dni" v-model="detalle.agresor_dni">
                                                                    <template slot="selection" slot-scope="data">
                                                                        {{ data.item.dni+" "+data.item.ape_paterno+" "+data.item.ape_materno+" "+data.item.nombres }}
                                                                    </template>
                                                                    <template slot="item" slot-scope="data">
                                                                        {{ data.item.dni+" "+data.item.ape_paterno+" "+data.item.ape_materno+" "+data.item.nombres }}
                                                                    </template>
                                                                </v-select>
                                                            </v-col>
                                                            <v-col>
                                                                <v-btn class="error" @click="removeDetalle(d)" >Eliminar</v-btn>
                                                            </v-col>
                                                        </v-row>
                                                        <v-row>
                                                            <v-col>
                                                                <v-text-field dense v-model="detalle.vinculo" label="Vinculo" />
                                                            </v-col>
                                                            <v-col>
                                                                <v-text-field dense v-model="detalle.comentario" label="Comentario" />
                                                            </v-col>
                                                            <v-col>
                                                                <v-select :items="tipos" v-model="detalle.tipos" multiple dense label="Tipo" />
                                                            </v-col>
                                                        </v-row>
                                                    </v-card-text>
                                                </v-card>
                                            </v-card-text>
                                            <v-card-actions>
                                                <v-btn class="success" @click="save">Guardar</v-btn>
                                                <v-btn class="error" @click="close">Cancelar</v-btn>
                                            </v-card-actions>
                                        </v-card>
                                    </v-dialog>
                                    <v-dialog v-model="dialogShow" max-width="800px" persistent>
                                        <v-card>
                                            <v-card-title>Caso {{ editedCaso.ficha }} </v-card-title>
                                            <v-card-text v-if="editedCaso.denunciante">
                                                <v-tabs v-model="tab" background-color="deep-purple accent-4" centered dark>
                                                    <v-tabs-slider></v-tabs-slider>
                                                    <v-tab>
                                                        Detalle
                                                    </v-tab>
                                                    <v-tab>
                                                        Seguimiento
                                                    </v-tab>
                                                </v-tabs>
                                                <v-tabs-items v-model="tab">
                                                    <v-tab-item>
                                                        <v-card>
                                                            <v-card-text>
                                                                <v-row>
                                                                    <v-col>
                                                                        <v-text-field :disabled="caso_detalles!=''" v-model="editedCaso.denunciante.ape_paterno" label="Apellido Paterno" />
                                                                    </v-col>
                                                                    <v-col>
                                                                        <v-text-field :disabled="caso_detalles!=''" v-model="editedCaso.denunciante.ape_materno" label="Apellido Materno" />
                                                                    </v-col>
                                                                    <v-col>
                                                                        <v-text-field :disabled="caso_detalles!=''" v-model="editedCaso.denunciante.nombres" label="Nombre" />
                                                                    </v-col>
                                                                </v-row>
                                                                <v-row>
                                                                    <v-col>
                                                                        <v-text-field :disabled="caso_detalles!=''" v-model="editedCaso.denunciante.celular" label="Celular" />
                                                                    </v-col>
                                                                    <v-col>
                                                                        <v-text-field :disabled="caso_detalles!=''" v-model="editedCaso.denunciante.edad" label="Edad" />
                                                                    </v-col>
                                                                    <v-col>
                                                                        <v-text-field :disabled="caso_detalles!=''" v-model="editedCaso.denunciante.nivel_riesgo" label="Nivel de Riesgo" />
                                                                    </v-col>
                                                                </v-row>
                                                                <v-card outlined>
                                                                    <v-card-title>Agresores</v-card-title>
                                                                    <v-card-text v-for="(caso_detalle,cd) in caso_detalles" :key="cd">
                                                                        <v-row>
                                                                            <v-col>
                                                                                {{ caso_detalle.letra_asignada }}
                                                                            </v-col>
                                                                        </v-row>
                                                                        <v-row>
                                                                            <v-col>
                                                                                <v-text-field :disabled="caso_detalles!=''" label="Apellido Paterno" dense v-model="caso_detalle.agresor.ape_paterno "/>
                                                                            </v-col>
                                                                            <v-col>
                                                                                <v-text-field :disabled="caso_detalles!=''" label="Apellido Materno" dense v-model="caso_detalle.agresor.ape_materno "/>
                                                                            </v-col>
                                                                            <v-col>
                                                                                <v-text-field :disabled="caso_detalles!=''" label="Nombre" dense v-model="caso_detalle.agresor.nombres "/>
                                                                            </v-col>
                                                                        </v-row>
                                                                        <v-row>
                                                                            <v-col>
                                                                                <v-text-field :disabled="caso_detalles!=''" label="DNI" dense v-model="caso_detalle.agresor_dni "/>
                                                                            </v-col>
                                                                            <v-col>
                                                                                <v-text-field :disabled="caso_detalles!=''" label="Vinculo" dense v-model="caso_detalle.vinculo "/>
                                                                            </v-col>
                                                                        </v-row>
                                                                        <v-row>
                                                                            <v-col>
                                                                                <v-text-field :disabled="caso_detalles!=''" label="Comentario" dense v-model="caso_detalle.comentario "/>
                                                                            </v-col>
                                                                            <v-col>
                                                                                <v-select :disabled="caso_detalles!=''" :items="tipos" v-model="caso_detalle.tipos_violacion" multiple dense label="Tipo" />
                                                                            </v-col>
                                                                        </v-row>
                                                                    </v-card-text>
                                                                </v-card>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-tab-item>
                                                    <v-tab-item>
                                                        <v-card>
                                                            <v-card-text >
                                                                <v-data-table dense :items="seguimientos" :headers="seguimientoHeaders" />
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-tab-item>
                                                </v-tabs-items>
                                            </v-card-text>
                                            <v-card-actions>
                                                <v-btn @click="closeShow" class="error">Cerrar</v-btn>
                                            </v-card-actions>
                                        </v-card>
                                    </v-dialog>
                                </v-toolbar>
                            </template>
                            <template v-slot:item.acciones="{ item }">
                                <v-icon small class="mr-2" @click="show(item)">
                                    mdi-eye
                                </v-icon>
                            </template>
                        </v-data-table>
                    </v-card-text>
                </v-card-text>
            </v-card>
        </v-flex>
    </v-layout>
</template>
<script>
export default {
    data(){
        return {
            tab:null,
            date: new Date().toISOString().substr(0, 10),
            menu: false,
            dialog:false,
            dialogShow:false,
            busqueda:'',
            casos:[],
            personas:[],
            editedIndex:-1,
            editedCaso:{
                turno:'',
                ficha:'',
                denunciante_dni:'',
                fecha_caso:'',
                lugar:'',
                medida:'',
                observacion_abogado:'',
            },
            defaultCaso:{
                turno:'',
                ficha:'',
                denunciante_dni:'',
                fecha_caso:'',
                lugar:'',
                medida:'',
                observacion_abogado:'',
            },
            detalles:[{
                agresor_dni:'',
                vinculo:'',
                comentario:'',
                tipos:[],
            }],
            caso_detalles:'',
            seguimientos:[],
        };
    },
    computed:{
        CasosHeaders(){
            return [
                {text:'Ficha',value:'ficha'},
                {text:'Registrado',value:'fecha_caso'},
                {text:'Nombres',value:'denunciante.nombres'},
                {text:'Apellido Paterno',value:'denunciante.ape_paterno'},
                {text:'Apellido Materno',value:'denunciante.ape_materno'},
                {text:'Acciones',value:'acciones'},
            ];
        },
        formTitle () {
            return this.editedIndex === -1 ? 'Nuevo Caso' : 'Editar Caso'
        },
        agresores(){
            if(!this.personas.length){
                return this.personas
            }
            let agresores_array = []
            this.personas.forEach(persona => {
                if(persona.dni != this.editedCaso.denunciante_dni)
                {
                    agresores_array.push(persona)
                }
            });
            return agresores_array
        },
        turnos(){
            return [
                {value:'L-V-M',text:'LUNES A VIERNES MAÑANA'},
                {value:'L-V-T',text:'LUNES A VIERNES TARDE'},
                {value:'L-V-N',text:'LUNES A VIERNES NOCHE'},
                {value:'FDSM-D',text:'FIN DE SEMANA DIA'},
                {value:'FDSM-N',text:'FIN DE SEMANA NOCHE'},
            ];
        },
        tipos(){
            return [
                {value:'VIOLENCIA FISICA',text:'VIOLENCIA FISICA'},
                {value:'VIOLENCIA PSICOLOGICA',text:'VIOLENCIA PSICOLOGICA'},
                {value:'VIOLENCIA PATRIMONIAL',text:'VIOLENCIA PATRIMONIAL'},
                {value:'VIOLENCIA SEXUAL',text:'VIOLENCIA SEXUAL'},
            ];
        },
        medidas(){
            return [
                {value:'CON',text:'CONCEDIDAS'},
                {value:'NO-CON',text:'NO CONCEDIDAS'},
                {value:'EN-PROCE',text:'EN PROCESO'},
            ];
        },
        seguimientoHeaders(){
            return [
                {value:'fecha',text:'Fecha'},
                {value:'personal',text:'Personal'},
                {value:'comentario',text:'Comentario'},
            ];
        }
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
            this.detalles = [{
                agresor_dni:'',
                vinculo:'',
                comentario:'',
            }]
        },
        save(){
            let formData = new FormData
            let index = 0
            formData.append('denunciante_dni',this.editedCaso.denunciante_dni)
            formData.append('fecha_caso',this.editedCaso.fecha_caso)
            formData.append('ficha',this.editedCaso.ficha)
            formData.append('lugar',this.editedCaso.lugar)
            formData.append('medida',this.editedCaso.medida)
            formData.append('observacion_abogado',this.editedCaso.observacion_abogado)
            formData.append('tipo',this.editedCaso.tipo)
            formData.append('turno',this.editedCaso.turno)
            this.detalles.forEach(detalle => {
                formData.append('detalles['+index+'][agresor_dni]',detalle.agresor_dni)
                formData.append('detalles['+index+'][comentario]',detalle.comentario)
                formData.append('detalles['+index+'][vinculo]',detalle.vinculo)
                let index_tipos = 0
                detalle.tipos.forEach(tipo => {
                    formData.append('detalles['+index+'][tipos]['+index_tipos+']',tipo)
                    index_tipos++
                });
                index++
            });
            axios.post('caso',formData).then(response=>{
                this.getData()
                this.close()
                Swal.fire({
                    icon:'success',
                    text:'Registro Correcto'
                })
            }).catch(error =>{
                this.showError(error.response.data.errors)
            })
        },
        addDetalle(){
            this.detalles.push({
                agresor_dni:'',
                vinculo:'',
                comentario:'',
            })
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
            })
            Toast.fire({
                icon: 'warning',
                title : texto
            })
        },
        removeDetalle(index)
        {
            this.detalles.splice(index,1);
        },
        show(item){
            this.editedCaso = Object.assign({}, item)
            axios.get('caso/'+item.ficha).then(response=>{
                this.caso_detalles = response.data
                this.dialogShow = true
                if(response.data[0])
                {
                    response.data[0].seguimiento.forEach(item => {
                        this.seguimientos.push({
                            fecha:item.fecha,
                            personal:item.personal[0].id,
                            comentario:item.personal[0].pivot.comentario,
                        })
                    });
                }
            })
        },
        closeShow(){
            this.dialogShow = false
            this.caso_detalles = ''
            this.editedCaso = this.defaultCaso
            this.seguimientos = []
        },
    }
}
</script>