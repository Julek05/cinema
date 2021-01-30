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
            <li v-for="(addedGenre) in addedGenres">
                {{ genres[parseInt(addedGenre) - 1].name }}
            </li>
        </ul>
    </div>
</template>
<script>
    export default {
        props: ['genres'],

        data() {
            return {
                addedGenres: [],
            }
        },

        methods: {
            addGenre(event) {
                const genreId = event.target.value;
                if (! this.addedGenres.includes(genreId) && genreId !== '-1') {
                    this.addedGenres.push(genreId);
                }
            }
        }
    }
</script>
