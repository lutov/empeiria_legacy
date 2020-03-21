<template>

    <div class="card">
        <div class="card-header">Inventory</div>

        <div class="card-body">
            I'm an example component.
        </div>
    </div>

</template>

<script>
    export default {
        name: 'inventory-component',
        data() {
            return {
                loadInventory: {}
            };
        },
        methods: {

        },
        mounted() {
            console.log('Inventory Component mounted');
        }
    }
</script>
