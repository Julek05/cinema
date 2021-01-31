<template>
    <div>
        <label for="genres">
            Genre:
            <select id="genres" @change="addGenre($event)">
                <option :value="genre.id" v-for="(genre) in [{'id': -1, 'name': 'Choose option'}, ...genres]"
                        :key="genre.id" class="box fa">
                    {{ genre.name }}
                </option>
            </select>
        </label>
        <input type="hidden" name="genres" :value="addedGenres">

        <ul>
            <li v-for="(addedGenre, index) in addedGenres" :key="index">
                {{ genres.find(genre => genre.id === addedGenre).name }}
                <button type="button" @click="deleteGenre(index)">X</button>
            </li>
        </ul>
    </div>
</template>
<script>
    export default {
        props: ['genres'],

        data() {
            return {
                addedGenres: this.$props.genres.map(genre => genre.id),

            }
        },

        methods: {
            addGenre(event) {
                const genreId = parseInt(event.target.value);
                if (! this.addedGenres.includes(genreId) && genreId !== -1) {
                    this.addedGenres.push(genreId);
                }
            },

            deleteGenre(index) {
                this.addedGenres.splice(index, 1);
            }
        }
    }
</script>
