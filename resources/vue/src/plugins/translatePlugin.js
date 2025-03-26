import es from '../locales/es.json';
import en from '../locales/en.json';
import { useTranslationsStore } from '../store/translationsStore';

// Traducciones predeterminadas
const defaultTranslations = { es, en };

export default {
    install(app, options = {}) {
        // En lugar de llamar inmediatamente a useTranslationsStore(),
        // definimos una función que la invoque cuando se requiera.
        const getTranslationsStore = () => {
            return useTranslationsStore();
        };

        // Función para cargar el idioma
        const dealsLoadLocale = async (lang) => {
            try {
                const translationsStore = getTranslationsStore();

                // Usar traducciones personalizadas si están disponibles, con respaldo en las predeterminadas
                const customLocales = options.locales || {};
                const translationsForLang = customLocales[lang] || defaultTranslations[lang];

                if (!translationsForLang) {
                    throw new Error(`Idioma no soportado: ${lang}`);
                }

                translationsStore.setLang(lang);
                translationsStore.loadTranslations(translationsForLang);
            } catch (error) {
                console.error(
                    `No se pudieron cargar las traducciones para el idioma: ${lang}`,
                    error
                );
            }
        };

        // Función para traducir cadenas
        const translate = (string) => {
            return getTranslationsStore().translate(string);
        };

        // Registrar como propiedades globales
        app.config.globalProperties.__deals = translate;
        app.config.globalProperties.$dealsLoadLocale = dealsLoadLocale;

        // Registrar como inyectables
        app.provide('__deals', translate);
        app.provide('$dealsLoadLocale', dealsLoadLocale);

        // Cargar el idioma por defecto si se proporciona
        if (options.defaultLang) {
            dealsLoadLocale(options.defaultLang);
        }
    },
};
