import DealsApp from './src/DealsApp.vue';
import dealsRoutes from './src/routes';
import { TranslatePlugin, TitlePlugin } from './src/plugins';
import PageHeader from './src/components/PageHeader.vue';

export const routes = dealsRoutes;

export default {
    install(app, options = {}) {
        app.use(TranslatePlugin, options.translateOptions || {});
        app.use(TitlePlugin);
        app.component('PageHeader', PageHeader);
        app.component('DealsApp', DealsApp);
    }
};
