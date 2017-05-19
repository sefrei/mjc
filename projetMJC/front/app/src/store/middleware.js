/*
 * Npm import
 */


/*
 * Local import
 */


/*
 * Code
 */
const createMiddleware = store => next => (action) => {
  switch (action.type) {
    default:
  }

  next(action);
};


/*
 * Export default
 */
export default createMiddleware;
