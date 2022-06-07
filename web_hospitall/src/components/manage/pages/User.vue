<template>
    <Base :onInput="onInput">
    <Table :heading="['Ảnh đại diện', 'Họ tên', 'Số điện thoại', 'Email', 'Tình trạng']" hideCrud="true"
        :title="'Danh sách người dùng'" :loading="loading" :list="list">
        <tr v-for="(item, index) in list" :key="item.id">
            <td>{{ index + 1 }}</td>
            <td>
                <img :src="`${urlImage + item.avatar}`"
                    style="width: 8rem; height:8rem;object-fit: cover;border-radius: 100rem;" alt="" srcset="">
            </td>
            <td>
                {{ item.fullname }}
            </td>
            <td>
                {{ item.phone }}
            </td>
            <td>
                {{ item.email }}
            </td>
            <td>
                <span :class="item.status === 1 ? 'green' : 'red'">
                    {{ item.status === 1 ? 'Bình thường' : 'Khoá' }}</span>
            </td>
        </tr>
    </Table>
    </Base>
</template>
<script>
import Base from "./Base.vue";
import Table from "../Table.vue";
import Request from "../../../Request";
import { URL_IMAGE } from "../../../Config";
export default {
    components: {
        Base,
        Table
    },
    methods: {
        onInput: function (event) {
            this.loading = true;
            this.counter += 1;
            clearTimeout(this.timeOut);
            this.timeOut = setTimeout(async () => {
                try {
                    const result = await Request.Post(`/user-search`, {
                        value: event.target.value
                    });
                    this.list = result.data.data;
                    this.loading = false;
                } catch (error) {
                    alert(error);
                }
            }, 300);
        },
    },
    data() {
        return {
            list: [],
            loading: true,
            urlImage: URL_IMAGE,
            timeOut: null,
            counter: 0
        }
    },
    mounted() {
        (async () => {
            try {
                this.loading = true;
                const result = await Request.Get('/users');
                this.list = result.data.data;
                this.loading = false;
            } catch (error) {
                alert(error)
            }
        })();
    }
}
</script>