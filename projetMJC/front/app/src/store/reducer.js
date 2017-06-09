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
export const UP_DAY = 'UP_DAY';
export const DOWN_DAY = 'DOWN_DAY';
const SET_ACTIVITIES = 'SET_ACTIVITIES';
const SET_USER = 'SET_USER';
export const SWITCH_PRESENCE = 'SWITCH_PRESENCE_TEACHER';
export const SWITCH_PRESENCE_STUDENT = 'SWITCH_PRESENCE_STUDENT';
const INPUT_OBSERVATION_CHANGE = 'INPUT_OBSERVATION_CHANGE';
const RESET_OBSERVATION = 'RESET_OBSERVATION';
const DISPLAY_NOTIFICATIONS = 'DISPLAY_NOTIFICATIONS';
const CHANGE_STATE_NOTIFICATION = 'CHANGE_STATE_NOTIFICATIONS';

/*
 * initialState
 */
export const initialState = {
  currentDate: moment(),
  user: {},
  activities: [],
  notifications: datas.notifications,
  nextDayActivities: datas.nextDayActivities,
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
    case UP_DAY:
      {
        let newObj = {
          ...state.currentDate,
        };
        newObj = moment(newObj);
        newObj.add(1, 'days');
        return {
          ...state,
          currentDate: newObj,
        };
      }
    case DOWN_DAY:
      {
        let newObj = {
          ...state.currentDate,
        };
        newObj = moment(newObj);
        newObj.add(-1, 'days');
        return {
          ...state,
          currentDate: newObj,
        };
      }
    case SET_ACTIVITIES:
      {
        return {
          ...state,
          activities: action.activities,
        };
      }
    case SET_USER:
      {
        return {
          ...state,
          user: action.user,
        };
      }
    case SWITCH_PRESENCE:
      {
        let { id } = action;
        id = parseInt(id, 10);
        const activities = [...state.activities];
        activities.forEach((activity) => {
          if (activity.activity_id === id) {
            if (action.userType === 'ROLE_TEACHER') {
              activity.presenceTeacher = !activity.presenceTeacher;
            }
            else {
              activity.presenceStudent = !activity.presenceStudent;
            }
          }
        });
        return {
          ...state,
          activities,
        };
      }
    case SWITCH_PRESENCE_STUDENT:
      {
        let { id } = action;
        id = parseInt(id, 10);
        const activities = [...state.activities];
        activities.forEach((activity) => {
          if (activity.activity_id === id) {
            activity.presenceStudent = !activity.presenceStudent;
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
        const { input } = action;
        id = parseInt(id, 10);
        const activities = [...state.activities];
        activities.forEach((activity) => {
          if (activity.activity_id === id) {
            activity.appreciation = input;
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
          if (activity.activity_id === id) {
            console.info('action : Axios récupérer lobservation en bdd pour cette activité');
            activity.appreciation = activity.observation;
          }
        });
        return {
          ...state,
          activities,
        };
      }
    case DISPLAY_NOTIFICATIONS:
      {
        const display = !state.displayNotifications;
        return {
          ...state,
          displayNotifications: display,
        };
      }
    case CHANGE_STATE_NOTIFICATION:
      {
        const { id } = action;
        const notifications = [...state.notifications];
        notifications.forEach((notif) => {
          if (notif.id === id) {
            console.info('action : Axios changer letat de la notif');
            notif.state = false;
          }
        });
        return {
          ...state,
          notifications,
        };
      }
    default:
      return state;
  }
};

/*
 * Action creators
 */
export const changeDate = date => (
  {
    type: CHANGE_DATE,
    date,
  }
);
export const upDay = () => (
  {
    type: UP_DAY,
  }
);

export const downDay = () => (
  {
    type: DOWN_DAY,
  }
);
export const switchPresenceTeacher = (id, presenceTeacher) => {
  return ({
    type: SWITCH_PRESENCE,
    userType: 'ROLE_TEACHER',
    presence: presenceTeacher,
    id,
  });
};
export const switchPresenceStudent = (id, presenceStudent) => {
  return ({
    type: SWITCH_PRESENCE,
    userType: 'ROLE_STUDENT',
    presence: presenceStudent,
    id,
  });
};
export const setActivities = activities => ({
  type: SET_ACTIVITIES,
  activities,
});
export const setUser = user => ({
  type: SET_USER,
  user,
});
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
export const changeNotificationState = id => ({
  type: CHANGE_STATE_NOTIFICATION,
  id,
});


/*
 * Action Selectors
 */
export const selectActivity = (state, props) => {
  const id = parseInt(props, 10);
  const activitySelected = state.activities.filter(activity => (
    activity.activity_id === id
  ));
  if (activitySelected.length) {
    return activitySelected[0];
  }
  return null;
};
