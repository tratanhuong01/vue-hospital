<template>
    <div v-if="!loading">
        <div v-if="blog" class="wrapper blog blog__flex">
            <div>
                <h1 class="blog__title">
                    {{ blog.title }}
                </h1>
                <div class="blog__child">
                    <span>{{ blog.type_blog === 0 ? 'Bài viết thông thườngg' : 'Bài viết công nghệ' }}</span>
                    <p>Thứ Hai, {{ blog.created_at }} +07:00</p>
                </div>
                <br />
                <hr />
                <br />
                <div v-html="blog.content"></div>
            </div>
            <div>
                <ItemBlogDetail v-for="item in list" :key="item.id" :item="item" />
            </div>
        </div>
        <div v-else></div>
    </div>
    <div class="wrapper blog" v-else>
        <div class="loading__content">
            <span class="bx bx-loader loading"></span>
        </div>
    </div>
    <div class="wrapper">
        <br />
        <p class="reply__title">
            Bình luận
        </p>
        <ItemReplyBlog />
    </div>
</template>
<script>
import Request from '../../Request';
import ItemBlogDetail from './components/ItemComponent/ItemBlogDetail.vue';
import ItemReplyBlog from './components/ItemComponent/ItemReplyBlog.vue';
export default {
    components: { ItemBlogDetail, ItemReplyBlog },
    data() {
        return {
            blog: null,
            loading: true,
            list: []
        }
    },
    mounted() {
        (async () => {
            try {
                let result = await Request.Post('/blog-slug', {
                    slug: this.$route.params.slug
                });
                this.blog = result.data.data;
                result = await Request.Post('/blog-different', {
                    slug: this.$route.params.slug
                });
                this.list = result.data.data;
                this.loading = false;
            } catch (error) {
                alert(error);
            }
        })();
    }
}
</script>