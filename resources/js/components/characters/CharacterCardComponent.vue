<template>
    <div class="col-2 mb-2">
        <div class="card">
            <div class="card-header"><a :href="'/home/characters/'+character.id">{{character.name}}</a></div>
            <div class="card-body"></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "character-card-component",
        props: {
            character: {
                type: Object,
                required: true
            }
        },
    }
</script>

<style scoped>

</style>
