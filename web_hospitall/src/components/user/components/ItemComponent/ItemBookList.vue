<template>
    <div class="item-booklist">
        <div class="item-booklist__doctor">
            <p>Bác sĩ</p>
            <img :src="urlImage + item.avatar_doctor" alt="" srcset="">
            <p>{{ item.name_doctor }}</p>
            <span>{{ item.namespecical }}</span>
        </div>
        <div class="item-booklist__info">
            <p>{{ item.name + "/" + item.year }} - {{ item.time }}</p>
            <p><span>Họ tên </span> : {{ item.fullname_main }}</p>
            <p><span>Giới tính </span> : {{ item.gender_main }}</p>
            <p><span>Địa chỉ </span> : {{ item.address_main }}</p>
            <p><span>Số điện thoại </span> : {{ item.phone_main }} </p>
            <p><span>Lý do </span> : </p>
        </div>
        <div class="item-booklist__status cancel">
            <span @click="handleStatus" v-if="!loading" :style="{ background: status.color }">{{ status.name }}</span>
            <span v-else class="bx bx-loader loading" style="color:var(--color-bold);font-size: 2rem;"></span>
        </div>
    </div>
</template>
<script>
import { URL_IMAGE } from '../../../../Config'
import Request from '../../../../Request';

export default {
    props: ['item'],
    data() {
        return {
            status: {
                name: '',
                value: '',
                color: ''
            },
            loading: false,
            urlImage: URL_IMAGE
        }
    },
    methods: {
        statusItem: function (status) {
            switch (status) {
                case -1:
                    this.status.name = 'Đã huỷ';
                    this.status.value = -1;
                    this.status.color = 'gray';
                    break;
                case 0:
                    this.status.name = 'Huỷ';
                    this.status.value = 0;
                    this.status.color = 'red';
                    break;
                case 1:
                    this.status.name = 'Đã duyệt';
                    this.status.value = 1;
                    this.status.color = 'green';
                    break;
                case 2:
                    this.status.name = 'Đã khám';
                    this.status.value = 2;
                    this.status.color = 'var(--color-bold)';
                    break;
            }
        },
        handleStatus: async function () {
            try {
                if (this.item.status_book_list === 0) {
                    this.loading = true;
                    await Request.Post('/booklist-status', {
                        id: this.item.idbooklist_main,
                        status: -1
                    })
                    this.statusItem(-1);
                    this.loading = false;
                }
            } catch (error) {
                alert(error);
            }
        }
    },
    mounted() {
        this.statusItem(this.item.status_book_list)
    }
}
</script>