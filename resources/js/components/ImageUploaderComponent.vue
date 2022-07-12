<template>
    <file-pond
      name="image"
      ref="pond"
      label-idle="Drop Or Browse"
      v-bind:allow-multiple="false"
      accepted-file-types="image/jpeg, image/png"
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
            // FilePond instance methods are available on `this.$refs.pond`
            setOptions({
                server: {
                    process: this.url,
                    fetch: null,
                    revert: null,
                    headers:{
                        'X-CSRF-TOKEN': this.csrf,
                    }
                },
                instantUpload: true,
                imageResizeTargetWidth: 200,
                imageResizeTargetHeight: 200,
            });
        },
    },
    mounted() {
        
    },
    components: {
        FilePond,
    },
}
</script>