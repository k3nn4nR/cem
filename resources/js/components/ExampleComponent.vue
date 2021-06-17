<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Example Component</div>
                    <div class="card-body">
                        <v-row>
                            <v-col>
                                <Seguimientos/>
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
    import Seguimientos from './Seguimientos.vue';
    export default {
        components:{
            Seguimientos,
        },
        mounted() {

        },
        methods:{

        }
    }
</script>
