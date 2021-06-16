<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Example Component</div>
                    <div class="card-body">
                        <v-row>
                            <v-col>
                                <Persona/>
                            </v-col>
                            <v-col>
                                <Casos/>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <Personal/>
                            </v-col>
                        </v-row>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Persona from  './Personas.vue';
    import Personal from  './Personal.vue';
    import Casos from  './Casos.vue';
    export default {
        components:{
            Persona,
            Casos,
            Personal,
        },
        data(){
            return {

            };
        },
        mounted() {

        },
        methods:{

        }
    }
</script>
