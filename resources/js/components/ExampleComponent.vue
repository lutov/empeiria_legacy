<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import * as d3 from "d3";

    export default {

        data() {
            return {
                loadWorld: {}
            };
        },

        methods: {

            async fetchWorld() {

                try {

                    let world = await d3.json('/api/world');
                    //console.log(world);

                    this.loadWorld = world;

                    //console.log('World fetched');

                } catch(error) {

                    console.log(error);

                }

            }

        },

        mounted() {

            console.log('Component mounted');
            this.fetchWorld();

        }

    }

</script>
