<template>
    <v-card>
        <v-card-text>
            <v-row class="fill-height">
                <v-col>
                    <v-sheet height="64">
                        <v-toolbar flat >
                            <v-btn outlined class="mr-4" color="grey darken-2" @click="setToday" >
                                Today
                            </v-btn>
                            <v-btn fab text small color="grey darken-2" @click="prev" >
                                <v-icon small>
                                    mdi-chevron-left
                                </v-icon>
                            </v-btn>
                            <v-btn fab text small color="grey darken-2" @click="next" >
                                <v-icon small>
                                    mdi-chevron-right
                                </v-icon>
                            </v-btn>
                            <v-toolbar-title v-if="$refs.calendar">
                                {{ $refs.calendar.title }}
                            </v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-menu bottom right >
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn outlined color="grey darken-2" v-bind="attrs" v-on="on" >
                                        <span>{{ typeToLabel[type] }}</span>
                                        <v-icon right>
                                            mdi-menu-down
                                        </v-icon>
                                    </v-btn>
                                </template>
                                <v-list>
                                    <v-list-item @click="type = 'day'">
                                        <v-list-item-title>Day</v-list-item-title>
                                    </v-list-item>
                                    <v-list-item @click="type = 'week'">
                                        <v-list-item-title>Week</v-list-item-title>
                                    </v-list-item>
                                    <v-list-item @click="type = 'month'">
                                        <v-list-item-title>Month</v-list-item-title>
                                    </v-list-item>
                                    <v-list-item @click="type = '4day'">
                                        <v-list-item-title>4 days</v-list-item-title>
                                    </v-list-item>
                                </v-list>
                            </v-menu>
                            <v-spacer></v-spacer>
                            <v-dialog v-model="dialog" max-width="700px" persistent>
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn color="success" dark class="mb-2" v-bind="attrs" v-on="on" >
                                        +
                                    </v-btn>
                                </template>
                                <v-card>
                                    <v-card-title><span class="text-h5">Registrar Seguimiento</span></v-card-title>
                                    <v-card-text>
                                        <v-row>
                                            <v-col>
                                                <v-select dense :items="casos" label="Casos" v-model="casoSelected">
                                                    <template slot="selection" slot-scope="data">
                                                        {{ data.item.ficha }}
                                                    </template>
                                                    <template slot="item" slot-scope="data">
                                                        {{ data.item.ficha }}
                                                    </template>
                                                </v-select>
                                            </v-col>
                                            <v-col>
                                                <v-menu v-model="menu" :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y min-width="auto" >
                                                    <template v-slot:activator="{ on, attrs }">
                                                        <v-text-field dense v-model="fecha" label="Fecha del seguimiento" prepend-icon="mdi-calendar" readonly v-bind="attrs" v-on="on"/>
                                                    </template>
                                                    <v-date-picker v-model="fecha" @input="menu = false"/>
                                                </v-menu>
                                            </v-col>
                                            <v-col v-if="casoSelected">
                                                <v-text-field dense v-model="casoSelected.estado" label="Estado" />
                                            </v-col>
                                        </v-row>
                                        <v-row>
                                            <v-col>
                                                <v-select multiple dense :items="personales" label="Personal" item-value="id" v-model="personalesSelected">
                                                    <template slot="selection" slot-scope="data">
                                                        {{ data.item.id }}
                                                    </template>
                                                    <template slot="item" slot-scope="data">
                                                        {{ data.item.id }}
                                                    </template>
                                                </v-select>
                                            </v-col>
                                            <v-col>
                                                <v-text-field label="Comentario" v-model="comentario" dense/>
                                            </v-col>
                                        </v-row>
                                        <v-row v-if="casoSelected">
                                            <v-col>
                                                <v-text-field dense v-model="casoSelected.lugar" label="Lugar" />
                                            </v-col>
                                        </v-row>
                                        <v-row v-if="casoSelected">
                                            <v-col>
                                                <v-select :items="medidas" v-model="casoSelected.medida" dense label="Medida" />
                                            </v-col>
                                            <v-col>
                                                <v-text-field dense v-model="casoSelected.observacion_abogado" label="Obsevacion Abogado" />
                                            </v-col>
                                        </v-row>
                                        <v-row v-if="casoSelected.denunciante" >
                                            <v-card outlined>
                                                <v-card-title>Denunciante</v-card-title>
                                                <v-card-text>
                                                    <v-row>
                                                        <v-col>
                                                            <v-text-field dense v-model="casoSelected.denunciante.ape_paterno" label="Apellido Paterno" />
                                                        </v-col>
                                                        <v-col>
                                                            <v-text-field dense v-model="casoSelected.denunciante.ape_materno" label="Apellido Materno" />
                                                        </v-col>
                                                        <v-col>
                                                            <v-text-field dense v-model="casoSelected.denunciante.nombres" label="Nombres" />
                                                        </v-col>
                                                    </v-row>
                                                </v-card-text>
                                            </v-card>
                                        </v-row>
                                        <v-row v-if="casoSelected.detalles">
                                            <v-card outlined>
                                                <v-card-title>Agresores</v-card-title>
                                                <v-card-text v-for="(detalle,d) in casoSelected.detalles" :key="d">
                                                    <v-row>
                                                        <v-col>
                                                            {{ detalle.letra_asignada }}
                                                        </v-col>
                                                    </v-row>
                                                    <v-row>
                                                        <v-col>
                                                            <v-text-field dense v-model="detalle.agresor.ape_paterno" label="Apellido Paterno" />
                                                        </v-col>
                                                        <v-col>
                                                            <v-text-field dense v-model="detalle.agresor.ape_materno" label="Apellido Materno" />
                                                        </v-col>
                                                        <v-col>
                                                            <v-text-field dense v-model="detalle.agresor.nombres" label="Nombres" />
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
                                                            <v-select :items="tipos" v-model="detalle.tipos_violacion" multiple dense label="Tipo" />
                                                        </v-col>
                                                    </v-row>
                                                </v-card-text>
                                            </v-card>
                                        </v-row>
                                    </v-card-text>
                                    <v-card-actions>
                                        <v-btn class="success" @click="save">Guardar</v-btn>
                                        <v-btn class="error" @click="close">Cancelar</v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>
                        </v-toolbar>
                    </v-sheet>
                    <v-sheet height="600">
                        <v-calendar ref="calendar" v-model="focus" color="primary" :events="events" :event-color="getEventColor" :type="type" @click:event="showEvent" @click:more="viewDay" @click:date="viewDay"/>
                        <v-menu v-model="selectedOpen" :close-on-content-click="false" :activator="selectedElement" offset-x >
                            <v-card color="grey lighten-4" min-width="350px" flat >
                                <v-toolbar :color="selectedEvent.color" dark >
                                    <v-toolbar-title v-html="selectedEvent.name"></v-toolbar-title>
                                    <v-spacer></v-spacer>
                                </v-toolbar>
                                <v-card-text v-if="selectedEvent.personal">
                                    <v-row v-for="(personal,p) in selectedEvent.personal" :key="p">
                                        <v-col>
                                            <v-text-field  v-model="personal.id" label="Personal" />
                                        </v-col>
                                        <v-col>
                                            <v-text-field  v-model="personal.pivot.comentario" label="Comentario" />
                                        </v-col>
                                    </v-row>
                                </v-card-text>
                                <v-card-actions>
                                    <v-btn class="error" @click="selectedOpen = false" >
                                        Cancel
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-menu>
                    </v-sheet>
                </v-col>
            </v-row>
        </v-card-text>
    </v-card>  
</template>
<script>
    export default {
        data: () => ({
            menu: false,
            dialog:false,
            seguimientos:[],
            comentario:'',
            fecha:'',
            casos:[],
            casoSelected:'',
            personales:[],
            personalesSelected:[],
            focus: '',
            type: 'month',
            typeToLabel: {
                month: 'Month',
                week: 'Week',
                day: 'Day',
                '4day': '4 Days',
            },
            selectedEvent: {},
            selectedElement: null,
            selectedOpen: false,
            events: [],
            colors: ['blue', 'indigo', 'deep-purple', 'cyan', 'green', 'orange', 'grey darken-1'],
            names: ['Meeting', 'Holiday', 'PTO', 'Travel', 'Event', 'Birthday', 'Conference', 'Party'],
        }),
        mounted () {
            this.$refs.calendar.checkChange()
            this.getData()
        },
        computed:{
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
        },
        watch:{
            seguimientos( val ){
                if(val > 0){
                    this.updateRange()
                }
            },            
        },
        methods: {
            viewDay ({ date }) {
                this.focus = date
                this.type = 'day'
            },
            getEventColor (event) {
                return event.color
            },
            setToday () {
                this.focus = ''
            },
            prev () {
                this.$refs.calendar.prev()
            },
            next () {
                this.$refs.calendar.next()
            },
            showEvent ({ nativeEvent, event }) {
                const open = () => {
                    this.selectedEvent = event
                    this.selectedElement = nativeEvent.target
                    requestAnimationFrame(() => requestAnimationFrame(() => this.selectedOpen = true))
                }
                if (this.selectedOpen) {
                    this.selectedOpen = false
                    requestAnimationFrame(() => requestAnimationFrame(() => open()))
                } else {
                    open()
                }
                nativeEvent.stopPropagation()
            },
            rnd (a, b) {
                return Math.floor((b - a + 1) * Math.random()) + a
            },
            getData(){
                axios.get('seguimiento').then(response=>{
                    const events = []
                    response.data.forEach(seguimiento => {
                        events.push({
                            name: ""+"Caso: "+seguimiento.detalles.caso_ficha+" Agresor: "+seguimiento.detalles.agresor.dni,
                            start: ""+seguimiento.fecha,
                            color: 'green',
                            details: seguimiento.detalles.agresor,
                            personal: seguimiento.personal,
                        })
                    });
                    this.events = events
                })
                axios.get('caso').then(response=>{this.casos = response.data})
                axios.get('personal').then(response=>{this.personales = response.data})
            },
            close () {
                this.dialog = false
                this.casoSelected = ''
                this.fecha = ''
                this.comentario = ''
                this.personalesSelected = []
            },
            save(){
                let formData = new FormData
                let index = 0
                formData.append('fecha',this.fecha)
                formData.append('comentario',this.comentario)
                if(this.casoSelected != ''){
                    this.casoSelected.detalles.forEach(detalle => {
                        formData.append('detalles['+index+']',detalle.id)
                        index++
                    });
                }
                index = 0
                if(this.personalesSelected != ''){
                    this.personalesSelected.forEach(personal => {
                        formData.append('personales['+index+']',personal)
                        index++
                    });
                }
                axios.post('seguimiento',formData).then(response=>{
                    this.close()
                    this.getData()
                }).catch(error =>{
                    var texto="";
                    for (var property in error.response.data.errors){
                        texto = texto + error.response.data.errors[property]+'\n';
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
                })
            },
        },
    }
</script>