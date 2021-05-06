<template>
    <div class="card mb-2">
        <div class="card-header">Inventory</div>
        <div class="card-body">
        </div>
    </div>
</template>

<script>
    export default {
        name: "character-inventory-component",
        props: {
            character: {
                type: Object,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>
