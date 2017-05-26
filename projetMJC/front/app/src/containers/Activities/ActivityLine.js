/*
 * Npm import
 */
import { connect } from 'react-redux';
/*
 * Local import
 */
import Activity from 'src/components/Activities/ActivityLine';

/*
 * Code
 */
const mapStateToProps = null;

const mapDispatchToProps = null;

/*
 * Component
 */
const createContainer = connect(mapStateToProps, mapDispatchToProps);
const ActivityLineContainer = createContainer(Activity);


/*
 * Export default
 */
export default ActivityLineContainer;
