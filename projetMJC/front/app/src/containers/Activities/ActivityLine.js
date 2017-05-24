/*
 * Npm import
 */
import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';

/*
 * Local import
 */
import Activity from 'src/components/Activities/ActivityLine';
import { switchPresenceTeacher } from 'src/store/reducer';

/*
 * Code
 */
const mapStateToProps = null;

const mapDispatchToProps = (dispatch, { id }) => ({
  actions: {
    switchPresenceTeacher: () => {
      console.log(id);
      dispatch(switchPresenceTeacher(id));
    },
  },
});

/*
 * Component
 */
const createContainer = connect(mapStateToProps, mapDispatchToProps);
const ActivityLineContainer = createContainer(Activity);


/*
 * Export default
 */
export default ActivityLineContainer;
