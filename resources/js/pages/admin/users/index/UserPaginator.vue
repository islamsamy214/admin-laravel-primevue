<template>
  <div class="row">
    <div class="col-md-6 col-sm-12">
      <h3>{{$t('total')}} : {{ total }}</h3>
    </div>
    <div class="col-md-6 col-sm-12">
      <div class="pagination justify-content-end">
        <nav aria-label="Page navigation">
          <ul class="pagination">
            <li class="page-item">
              <a
                class="page-link"
                href=""
                @click.prevent="$emit('fill', currentPage - 1)"
                v-if="currentPage != 1"
                >{{$t('previous')}}</a
              >
            </li>
            <li class="page-item" v-for="page in pages" :key="page">
              <a
                class="page-link"
                :class="{ active: page == currentPage }"
                href=""
                @click.prevent="$emit('fill', page)"
                >{{ page }}</a
              >
            </li>
            <li class="page-item">
              <a
                class="page-link"
                href=""
                @click.prevent="$emit('fill', currentPage + 1)"
                v-if="currentPage != pages.length"
                >{{$t('next')}}</a
              >
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["pages", "currentPage", "total"],
  emits: ["fill"],
};
</script>

<style scoped>
a.active {
  background-color: #007bff;
  color: #ffffff;
}
</style>