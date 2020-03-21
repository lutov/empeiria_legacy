<template>

    <div class="card">
        <div class="card-header">History</div>

        <div class="card-body">
            I'm an example component.
        </div>
    </div>

</template>

<script>
    export default {
        name: 'history-component',
        data() {
            return {
                loadHistory: {}
            };
        },
        methods: {

        },
        mounted() {
            console.log('History Component mounted');
        }
    }
</script>
