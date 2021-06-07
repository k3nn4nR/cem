<template>
    <v-card>
        <v-card-text>
            {{ casos }}
        </v-card-text>
    </v-card>
</template>
<script>
export default {
    data(){
        return {
            casos:[],
        };
    },
    mounted(){
        this.getData()
    },
    methods:{
        getData(){

}
    }
}
</script>