<template >
    <div v-if="book">
        <div class="wrapper breadcrumb">
            <ul>
                <li><a href="" class="bx bxs-home"></a></li>
                <li class="line">/</li>
                <li><a href="">Bác sĩ</a></li>
                <li class="line">/</li>
                <li><a href="">{{ specical ? specical.namespecical : '' }}</a></li>
            </ul>
        </div>
        <div class="wrapper">
            <div class="order__item--left detail" style="margin-bottom: 3rem;">
                <div>
                    <img class="order__item--left--image detail" :src="urlImage + book.doctor.info.avatar" alt=""
                        srcset="">
                </div>
                <div class="order__item--left--content">
                    <h3>{{ book.doctor.info.position }} {{ book.doctor.info.name }}</h3>
                    <div v-html="book.doctor.info.description_admin"></div>
                    <div class="order__item--left--content--footer">
                        <span class="bx bx-current-location"></span>
                        <span>{{ book.doctor.info.address }}</span>
                    </div>
                    <div class="post__socical">
                        <button>
                            <span class="bx bxs-like"></span>
                            <span>Like</span>
                        </button>
                        <button>
                            <span class="bx bxs-share"></span>
                            <span>Share</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="order__item--right row">
                <div class="col-lg-7">
                    <ItemCalendar :times="times" :doctor="book.doctor" :isDetail="true" :time_="book.time">
                    </ItemCalendar>
                </div>
                <div class="" style="flex: 1;flex-wrap: wrap;">
                    <ul class="col-12">
                        <li>ĐỊA CHỈ KHÁM</li>
                        <li>Bệnh viện Ung bướu Hưng Việt</li>
                        <li>34 Đại Cồ Việt, Hai Bà Trưng, Hà Nội</li>
                    </ul>
                </div>
            </div>
            <button @click="orderNow()" class="button-order">
                ĐẶT LỊCH NGAY
            </button>
        </div>
        <div class="order__container show ">
            <div v-if="specical" class="wrapper" style="padding: 2rem;">
                <h3>{{ specical.namespecical }}</h3>
                <h4>Bác sĩ Chuyên khoa {{ specical.namespecical }}</h4>
                <p v-html="specical.description_specical"></p>
            </div>
        </div>
        <div class="wrapper">
            <div class="reply">
                <p class="reply__title">
                    Phản hồi của bệnh nhân sau khi đi khám
                </p>
                <div class="reply__item">
                    <div class="reply__item--top">
                        <a href="">Đinh Công Sáng</a>
                        <span class="bx bxs-check-circle"></span>
                        <span>Đã khám ngày 06/04/2022</span>
                    </div>
                    <p class="reply__item--content">
                        Dịch vụ khám chữa bệnh rất tốt y bác sỹ nhiệt tình chu đáo và tôi rất yên tâm khi đến
                        đây.theo
                        suy nghĩ của tôi nếu như khám và phân loại bệnh nhân được sẽ tiết kiệm thời gian hơn cho
                        bệnh
                        nhân.xin cảm ơn các bạn
                    </p>
                </div>
                <hr>
            </div>
        </div>
    </div>
</template>
<script>
import { mapState } from 'vuex';
import { URL_IMAGE } from '../../Config';
import Request from '../../Request';
import ItemCalendar from './components/ItemComponent/ItemCalendar.vue';

export default {
    data() {
        return {
            times: [],
            specical: null,
            urlImage: URL_IMAGE
        };
    },
    methods: {
        orderNow: function () {
            this.$router.push({
                name: "DoctorForm", params: {
                    slug: this.$route.params.slug
                }
            });
        }
    },
    computed: {
        ...mapState(["book"])
    },
    mounted() {
        (async () => {
            try {
                if (!this.book) {
                    this.$router.push({
                        name: "Doctors", params: {
                            slug: this.$route.params.slug
                        }
                    });
                }
                let result = await Request.Get("/doctors");
                this.doctors = result.data.data;
                result = await Request.Get("/timebooks");
                this.times = result.data.data;
                result = await Request.Post("/specicallist-slug", {
                    slug: this.$route.params.slug
                });
                this.specical = result.data.data;
            } catch (error) {
                alert(error);
            }
        })();
    },
    components: { ItemCalendar }
}
</script>