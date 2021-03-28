<template>
    <div class="world-map">
        <div class="map-viewport" v-if="world.data">
            <div v-for="(row, y) in viewport.y" class="row">
                <div v-for="(col, x) in viewport.x" class="col tile" :style="'background-color: '+tiles[y][x]">
                    <div class="map-cell-content" :id="y+'-'+x" v-on:click="moveMainCharacter(y, x)">
                        <div class="small text-secondary">({{y}}; {{x}})</div>
                        <div class="map-marker-main-character"
                             v-if="((mainCharacter.data) && (mainCharacter.data.position.x === x) && (mainCharacter.data.position.y === y))">
                            {{mainCharacter.data.name}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                viewport: {
                    x: 12,
                    y: 4
                },
                mainCharacterId: 1,
                mainCharacter: {}
            };
        },
        methods: {
            randomNumber(min, max) {
                let rand = min + Math.random() * (max + 1 - min);
                return Math.floor(rand);
            },
            randomColorFactor() {
                //return Math.round(Math.random() * 255);
                let min = 50;
                let max = 200;
                return this.randomNumber(min, max);
            },
            randomColorData() {
                return {
                    red: this.randomColorFactor(),
                    green: this.randomColorFactor(),
                    blue: this.randomColorFactor()
                };
            },
            randomColor() {
                let color = this.randomColorData();
                let alpha = 1;
                return 'rgba(' + color.red + ',' + color.green + ',' + color.blue + ', ' + alpha + ')';
            },
            randomShade(color, step) {
                let min = 50;
                let max = 200;
                let shade = {
                    red: color.red,
                    green: color.green,
                    blue: color.blue
                };
                let direction = this.randomNumber(0, 1);
                if (1 === direction) {
                    if (max >= (color.red + step)) {
                        shade.red = color.red + step;
                    }
                    if (max >= (color.green + step)) {
                        shade.green = color.green + step;
                    }
                    if (max >= (color.blue + step)) {
                        shade.blue = color.blue + step;
                    }
                } else {
                    if (min <= (color.red - step)) {
                        shade.red = color.red - step;
                    }
                    if (min <= (color.green - step)) {
                        shade.green = color.green - step;
                    }
                    if (min <= (color.blue - step)) {
                        shade.blue = color.blue - step;
                    }
                }
                return shade;
            },
            rgba(color) {
                let alpha = 1;
                return 'rgba(' + color.red + ',' + color.green + ',' + color.blue + ', ' + alpha + ')';
            },
            async fetchMainCharacter() {
                try {
                    this.mainCharacter = await axios.get('/characters/' + this.mainCharacterId);
                } catch (error) {
                    console.error(error);
                }
            },
            async moveMainCharacter(y, x) {
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
        computed: {
            tiles: function () {
                let tiles = [];
                let color = this.randomColorData();
                for (let y = 0; y < this.viewport.y; y++) {
                    tiles[y] = [];
                    for (let x = 0; x < this.viewport.x; x++) {
                        tiles[y][x] = this.rgba(color);
                        let step = this.randomNumber(5, 15);
                        color = this.randomShade(color, step);
                    }
                }
                return tiles;
            }
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

    .tile {
        outline: 1px solid var(--dark);
    }

    .tile:after {
        content: '';
        display: block;
        margin-top: 100%;
    }

    .tile:hover {
        outline: 2px solid var(--dark);
        outline-offset: -2px;
        cursor: pointer;
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
