<template>
    <div class="container card p-3 mt-5">
        <div class="col-md-3">
            <select class="form-control" v-model="category_id" id="category">
                <option value="">-- choose category --</option>
                <option v-for="category in categories" :value="category.id">
                    {{ category.name }}
                </option>
            </select>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>
                        <a href="#" @click.prevent="changeSort('title')"
                            >Title</a
                        >
                        <span v-if="sort_field === 'title'">
                            <span v-if="sort_direction === 'asc'">&uarr;</span>
                            <span v-if="sort_direction === 'desc'">&darr;</span>
                        </span>
                    </th>
                    <th>
                        <a href="#" @click.prevent="changeSort('text')">Text</a>
                        <span v-if="sort_field === 'text'">
                            <span v-if="sort_direction === 'asc'">&uarr;</span>
                            <span v-if="sort_direction === 'desc'">&darr;</span>
                        </span>
                    </th>
                    <th>
                        <a href="#" @click.prevent="changeSort('created_at')"
                            >Created Date</a
                        >
                        <span v-if="sort_field === 'created_at'">
                            <span v-if="sort_direction === 'asc'">&uarr;</span>
                            <span v-if="sort_direction === 'desc'">&darr;</span>
                        </span>
                    </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="post in posts.data">
                    <td>{{ post.title }}</td>
                    <td>{{ post.text }}</td>
                    <td>{{ post.created_at }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <pagination
            :data="posts"
            @pagination-change-page="getResults"
        ></pagination>
    </div>
</template>

<script>
export default {
    data() {
        return {
            posts: {},
            categories: {},
            category_id: "",
            sort_field: "created_at",
            sort_direction: "desc",
        };
    },
    mounted() {
        this.getResults();
        this.getCategories();
    },
    watch: {
        category_id(val) {
            this.getResults();
        },
    },
    methods: {
        getResults(page = 1) {
            axios
                .get(
                    `
                /api/posts?page=${page}
                &category_id=${this.category_id}
                &sort_field=${this.sort_field}
                &sort_direction=${this.sort_direction}
            `
                )
                .then((response) => {
                    this.posts = response.data;
                });
        },
        getCategories() {
            axios.get("/api/categories").then((response) => {
                this.categories = response.data.data;
            });
        },
        changeSort(field) {
            if (this.sort_field === field) {
                this.sort_direction =
                    this.sort_direction === "asc" ? "desc" : "asc";
            } else {
                this.sort_field = field;
                this.sort_direction = "asc";
            }
            this.getResults();
        },
    },
};
</script>
