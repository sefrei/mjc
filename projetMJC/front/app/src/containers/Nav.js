/*
 * Npm import
 */
import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';

/*
 * Local import
 */
import Nav from 'src/components/Nav';
import { changeDate, changeDay } from 'src/store/reducer';

/*
 * Code
 */
const mapStateToProps = state => ({
  currentDate: state.currentDate,
});

const mapDispatchToProps = dispatch => ({
  actions: bindActionCreators({ changeDate, changeDay }, dispatch),
});

/*
 * Component
 */
const createContainer = connect(mapStateToProps, mapDispatchToProps);
const NavContainer = createContainer(Nav);


/*
 * Export default
 */
export default NavContainer;
