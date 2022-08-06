import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import path from 'path'
// import inject from '@rollup/plugin-inject';
// import bootstrap from 'bootstrap';
// import {getjQuery} from "bootstrap/js/src/util";
// import jQuery from 'jquery'
// import jQueryUI from 'jquery-ui'
// import jQueryTypeAhead from 'jquery-typeahead'
// import {getjQuery} from "bootstrap/js/src/util";
export default defineConfig({
    plugins: [
        // inject({
        //     $: 'jquery',
        //     jQuery: 'jquery',
        // }),
        laravel([
            'resources/js/app.js',
        ]),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
             '~jquery': path.resolve(__dirname, 'node_modules/jquery')
        }
    },
})
