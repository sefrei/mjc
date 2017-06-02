/*
 * Npm import
 */
import { connect } from 'react-redux';

/*
 * Local import
 */
import Presence from 'src/components/Presence';
import { switchPresenceTeacher, switchPresenceStudent } from 'src/store/reducer';

/*
 * Code
 */
const mapStateToProps = state => ({
  user: state.user,
});

const mapDispatchToProps = (dispatch, { id }) => ({
  actions: {
    switchPresenceTeacher: () => {
      dispatch(switchPresenceTeacher(id));
    },
    switchPresenceStudent: () => {
      dispatch(switchPresenceStudent(id));
    },
  },
});

/*
 * Component
 */
const createContainer = connect(mapStateToProps, mapDispatchToProps);
const PresenceContainer = createContainer(Presence);


/*
 * Export default
 */
export default PresenceContainer;
