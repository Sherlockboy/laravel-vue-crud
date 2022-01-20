<template>
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
        <tr v-for="post in posts">
            <td>{{ post.title }}</td>
            <td>{{ post.text }}</td>
            <td>{{ post.created_at }}</td>
            <td></td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        data() {
            return {
                posts: []
            }
        },
        mounted() {
            axios.get('/api/posts').then(res => {
                this.posts = res.data.data;
            })
        }
    }
</script>
