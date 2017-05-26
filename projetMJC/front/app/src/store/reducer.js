/*
 * Npm Import
 */
import moment from 'moment';
import 'moment/locale/fr';
/*
 * Local import
 */
import datas from 'src/datas';
/*
 * Types
 */
export const CHANGE_DATE = 'CHANGE_DATE';
const SET_ACTIVITIES = 'SET_ACTIVITIES';
const SWITCH_PRESENCE_TEACHER = 'SWITCH_PRESENCE';
const INPUT_OBSERVATION_CHANGE = 'INPUT_OBSERVATION_CHANGE';
const RESET_OBSERVATION = 'RESET_OBSERVATION';
const DISPLAY_NOTIFICATIONS = 'DISPLAY_NOTIFICATIONS';

/*
 * initialState
 */
const initialState = {
  currentDate: moment(),
  activities: datas.activity,
  notifications: datas.notifications,
  inputObservation: '',
  displayNotifications: false,
};


/*
 * Reducer
 */
export default (state = initialState, action = {}) => {
  switch (action.type) {
    case CHANGE_DATE:
      {
        return {
          ...state,
          currentDate: action.date,
        };
      }
    case SET_ACTIVITIES:
      {
        return {
          ...state,
          activities: action.activities,
        };
      }
    case SWITCH_PRESENCE_TEACHER:
      {
        let { id } = action;
        id = parseInt(id, 10);
        const activities = [...state.activities];
        activities.forEach((activity) => {
          if (activity.id === id) {
            activity.teacher = !activity.teacher;
          }
        });
        return {
          ...state,
          activities,
        };
      }
    case INPUT_OBSERVATION_CHANGE:
      {
        let { id } = action;
        console.info(typeof(id));
        const { input } = action;
        id = parseInt(id, 10);
        const activities = [...state.activities];
        activities.forEach((activity) => {
          if (activity.id === id) {
            activity.observation = input;
          }
        });
        return {
          ...state,
          activities,
        };
      }
    case RESET_OBSERVATION:
      {
        let { id } = action;
        id = parseInt(id, 10);
        const activities = [...state.activities];
        activities.forEach((activity) => {
          if (activity.id === id) {
            activity.observation = 'Valeur dans la BDD';
          }
        });
        return {
          ...state,
          activities,
        };
      }
    case DISPLAY_NOTIFICATIONS:
      {
        console.log('coucou');
        const display = !state.displayNotifications;
        console.log(display);
        return {
          ...state,
          displayNotifications: display,
        };
      }
    default:
      return state;
  }
};

/*
 * Action creators
 */
export const changeDate = (date) => {
  console.log('changeDate');
  return (
  {
    type: CHANGE_DATE,
    date,
  }
  );
};
export const switchPresenceTeacher = (id) => {
  console.log('switchPresenceTeacher');
  return ({
    type: SWITCH_PRESENCE_TEACHER,
    id,
  });
};
export const setActivities = (activities) => {
  console.log('SetActivities');
  return (
  {
    type: SET_ACTIVITIES,
    activities,
  }
  );
};
export const changeInputObservation = (input, id) => ({
  type: INPUT_OBSERVATION_CHANGE,
  input,
  id,
});
export const resetObservation = id => ({
  type: RESET_OBSERVATION,
  id,
});
export const displayNotifications = () => ({
  type: DISPLAY_NOTIFICATIONS,
});
/*
 * Action Selectors
 */
export const selectActivity = (state, props) => {
  const id = parseInt(props, 10);
  const activitySelected = state.activities.filter(activity => (
    activity.id === id
  ));
  if (activitySelected.length) {
    return activitySelected[0];
  }
  return null;
};
