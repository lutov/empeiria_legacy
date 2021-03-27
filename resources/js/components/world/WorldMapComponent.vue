<template>
    <div class="world-map">
        <table class="map" v-if="world.data">
            <tbody :style="'--rows: '+world.data.map.size_y+'; --cols: '+world.data.map.size_x+';'">
            <tr v-for="(row, y) in world.data.map.size_y">
                <td class="map-cell" v-for="(col, x) in world.data.map.size_x">
                    <div class="map-cell-content" :id="x+'-'+y" v-on:click="moveMainCharacter(x, y)">
                        <div class="small text-secondary">({{x}}; {{y}})</div>
                        <div class="map-marker-main-character"
                             v-if="((mainCharacter.data) && (mainCharacter.data.position.x === x) && (mainCharacter.data.position.y === y))">
                            {{mainCharacter.data.name}}
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "world-map-component",
        props: {
            world: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                mainCharacterId: 1,
                mainCharacter: {}
            };
        },
        methods: {
            async fetchMainCharacter() {
                try {
                    this.mainCharacter = await axios.get('/characters/' + this.mainCharacterId);
                } catch (error) {
                    console.error(error);
                }
            },
            async moveMainCharacter(x, y) {
                let params = {
                    x: x,
                    y: y
                };
                try {
                    this.characters = await axios.post('/characters/' + this.mainCharacterId + '/move', params);
                    this.fetchMainCharacter();
                } catch (error) {
                    console.error(error);
                }
            },
        },
        mounted() {
            this.fetchMainCharacter();
        }
    }
</script>

<style>
    :root {
        --border-color: #dee2e6;
        --map-cell-width: calc(100% / var(--cols));
    }

    .map {
        width: 100%;
        border-collapse: collapse;
    }

    .map-cell {
        width: var(--map-cell-width);
        position: relative;
        border: 1px solid var(--border-color);
    }

    .map-cell:after {
        content: '';
        display: block;
        margin-top: 100%;
    }

    .map-cell-content {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        padding: .75rem;
    }
</style>
