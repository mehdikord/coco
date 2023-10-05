<script>
export default {
    name: "Front_Errors_Validation",
    props : ['errors','classes']

}
</script>

<template>
    <div v-if="errors" class="text-red mt-1 mb-1" :class="classes"  v-for="(error,index) in errors" :key="index">

        {{ error }}
    </div>
</template>

<style scoped>

</style>
