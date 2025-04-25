export const eventHandler = (handlers = {}) => {
    return (context, event, vars = {}, callback = null) => {
        const handler = handlers[event];
        if (typeof handler === 'function') {
            handler(context, vars, callback);
        } else {
            console.warn(`⚠️ No existe un handler para el evento "${event}"`);
        }
    };
};
