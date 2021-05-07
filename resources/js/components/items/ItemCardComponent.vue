<template>
    <div class="col-2 mb-2">
        <div class="card">
            <div class="card-header"><a :href="'/home/items/'+item.id">{{item.name}}</a></div>
            <div class="card-body"></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "item-card-component",
        props: {
            item: {
                type: Object,
                required: true
            }
        },
    }
</script>

<style scoped>

</style>
