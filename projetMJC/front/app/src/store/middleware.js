/*
 * Npm import
 */
import axios from 'axios';

/*
 * Local import
 */
import { CHANGE_DATE, setActivities } from './reducer';
/*
 * Types
 */
const LOAD_ACTIVITIES = 'LOAD_ACTIVITIES';

/*
 * Code
 */
const createMiddleware = store => next => (action) => {
  switch (action.type) {
    case LOAD_ACTIVITIES:
    console.log(action.currentDate.format());
      // On fait une requête ajax pour récupérer les activités lié à la date et à (l'utilisateur)

      // Je dispatche mon action pour enregistrer ces nouvelles données dans mon state activités
      //store.dispatch(setActivities('activities'));
      break;
    case CHANGE_DATE:
        console.info('La date a changer : requete axios pour récupérer les nouvelles données');
        // axios
        // dispatch
      break;
    default:
  }

  next(action);
};


/*
 * Action creator
 */
export const loadActivities = currentDate => ({
  type: LOAD_ACTIVITIES,
  currentDate,
});

/*
 * Export default
 */
export default createMiddleware;
