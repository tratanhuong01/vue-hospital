<template>
    <div class="order__item row">
        <div class="order__item--left">
            <div>
                <img class="order__item--left--image" :src="urlImage + doctor.info.avatar" alt="" srcset="">
                <!-- <span class="order__item--left--text">
                    Xem thêm
                </span> -->
            </div>
            <div class="order__item--left--content">
                <h3>{{ doctor.info.position }} {{ doctor.info.name }}</h3>
                <div v-html="doctor.info.description_admin"></div>
                <div class="order__item--left--content--footer">
                    <span class="bx bx-current-location"></span>
                    <span>{{ doctor.info.address }}</span>
                </div>
            </div>
        </div>
        <div class="order__item--right">
            <ItemCalendar :times="times" :doctor="doctor"></ItemCalendar>
        </div>
    </div>
</template>
<script>

import { URL_IMAGE } from '../../../../Config';
import ItemCalendar from './ItemCalendar.vue';

export default {
    props: ["times", "doctor"],
    components: { ItemCalendar },
    data() {
        return {
            urlImage: URL_IMAGE
        }
    }
}
</script>
