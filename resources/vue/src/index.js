import dealsRoutes from './routes';
import { TranslatePlugin, TitlePlugin } from './plugins';

export const routes = dealsRoutes;

export default {
    install(app, options = {}) {
        app.use(TranslatePlugin, options.translateOptions || {});
        app.use(TitlePlugin);
    }
};
