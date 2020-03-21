<template>

    <div class="card">
        <div class="card-header">World</div>

        <div class="card-body">
            I'm an example component.
        </div>
    </div>

</template>

<script>

    import * as d3 from "d3";

    export default {
        name: 'world-component',
        data() {
            return {
                loadWorld: {}
            };
        },

        methods: {

            async fetchWorld() {

                this.loadWorld = await d3.json('/world');

            }

        },

        mounted() {

            console.log('World Component mounted');
            this.fetchWorld();

        }

    }

</script>
