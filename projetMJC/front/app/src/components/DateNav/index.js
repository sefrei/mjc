/*
 * Npm import
 */
import React from 'react';
import PropTypes from 'prop-types';
import DatePicker from 'react-datepicker';
/*
 * Local import
 */
 // CSS Modules, react-datepicker-cssmodules.css


/*
 * Code
 */
const Nav = ({ currentDate, actions }) => {
  console.info(currentDate);
  // Change
  const onChange = (evt) => {
    console.log(evt);
    actions.changeDate(evt);
  };
  // click
  const onClick = () => {
    const newDate = currentDate;
    newDate.add(1, 'days');
    actions.changeDate(newDate);
  };

  return (
    <div id="notebook-navigation">
      <button onClick={onClick} id="left-arrow" className="nav-arrow"><i className="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
      <DatePicker
        dateFormat="DD/MM/YYYY"
        selected={currentDate}
        onChange={onChange}
        className="date-picker"
        locale="fr"
      />
      <button onClick={onClick} id="right-arrow" className="nav-arrow"><i className="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
      <h2 id="date-title">{currentDate.format('dddd D MMMM YYYY')}</h2>
    </div>
  );
};

Nav.propTypes = {
  currentDate: PropTypes.object.isRequired,
  actions: PropTypes.objectOf(PropTypes.func.isRequired).isRequired,
};

/*
 * Export default
 */
export default Nav;
