<template>
    <Base :onInput="onInput">
    <Table :hideCrud="true" :title="'Danh sách lịch đặt khám'" :heading="['Tên khách hàng', 'Số điện thoại', 'Email', 'Tên bác sĩ', 'Giờ khám',
    'Ngày khám', 'Thời gian đặt', 'Tình trạng', 'Sửa']" :list="list" :loading="loading">
        <tr v-for="(item, index) in list" :key="item.id">
            <td>{{ index + 1 }}</td>
            <td>
                {{ item.fullname_main }}
            </td>
            <td>
                {{ item.phone_main }}
            </td>
            <td>
                {{ item.email_main }}
            </td>
            <td>
                {{ item.name_doctor }}
            </td>
            <td>
                {{ item.time }}
            </td>
            <td>
                {{ item.name + "/" + item.year }}
            </td>
            <td>
                {{ item.created_at_main }}
            </td>
            <td>
                <ItemStatus :statusMain="item.status_book_list"></ItemStatus>
            </td>
            <td>
                <span @click="editItem(item.idadmin)" class="bx bx-pencil"></span>
            </td>
        </tr>
    </Table>
    </Base>
</template>
<script>
import Base from "./Base.vue";
import Table from "../Table.vue";
import ItemStatus from '../../user/components/ItemComponent/ItemStatus.vue';
import Request from "../../../Request";
export default {
    components: {
        Base,
        Table,
        ItemStatus
    },
    methods: {
        onInput: function (event) {
            this.loading = true;
            this.counter += 1;
            clearTimeout(this.timeOut);
            this.timeOut = setTimeout(async () => {
                try {
                    const result = await Request.Post(`/booklist-search`, {
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
            counter: 0,
            timeOut: null
        }
    },
    mounted() {
        (async () => {
            try {
                const result = await Request.Get("/booklists");
                this.list = result.data.data;
                this.loading = false;
            } catch (error) {
                alert(error);
            }
        })();
    }
}
</script>