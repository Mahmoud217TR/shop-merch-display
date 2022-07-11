<template>
    <file-pond
      name="image"
      ref="pond"
      label-idle="Drop files here..."
      v-bind:allow-multiple="false"
      accepted-file-types="image/jpeg, image/png"
      :server="url"
      v-bind:files="myFiles"
      v-on:init="handleFilePondInit"
    />
</template>
<script>
import vueFilePond, { setOptions }from "vue-filepond";
import "filepond/dist/filepond.min.css";
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
import FilePondPluginImageResize from 'filepond-plugin-image-resize';

// Create component
const FilePond = vueFilePond(
  FilePondPluginFileValidateType,
  FilePondPluginImagePreview,
  FilePondPluginImageResize
);
export default {
    props:['url','csrf'],
    data() {
        return {
            myFiles: []
        }
    },
    methods: {
        handleFilePondInit() {
            console.log("FilePond has initialized");

            // FilePond instance methods are available on `this.$refs.pond`
        },
    },
    mounted() {
        setOptions({
            server: {
                'X-CSRF-TOKEN': this.csrf
            }
        });
    },
    components: {
        FilePond,
    },
}
</script>