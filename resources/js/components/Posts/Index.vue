<template>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Post Text</th>
                <th>Created Date</th>
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
        <pagination :data="posts" @pagination-change-page="getResults"></pagination>
    </div>
</template>

<script>
export default {
    data() {
        return {
            posts: {}
        }
    },
    mounted() {
        this.getResults()
    },
    methods: {
        getResults(page = 1) {
            axios.get('/api/posts?page=' + page)
                .then(response => {
                    this.posts = response.data;
                });
        }
    }
}
</script>
