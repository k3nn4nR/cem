<template>
    <v-card flat>
        <v-card-text>
            {{persona}}
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

        };
    },
    methods:{
        close(){
            this.$emit('delete');
        }
    }
}
</script>