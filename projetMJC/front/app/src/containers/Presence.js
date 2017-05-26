/*
 * Npm import
 */
import { connect } from 'react-redux';

/*
 * Local import
 */
import Presence from 'src/components/Presence';
import { switchPresenceTeacher } from 'src/store/reducer';

/*
 * Code
 */
const mapStateToProps = null;

const mapDispatchToProps = (dispatch, { id }) => ({
  actions: {
    switchPresenceTeacher: () => {
      dispatch(switchPresenceTeacher(id));
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
