import React, {Component} from "react";
import PropTypes from "prop-types";
import Paginator from "paginator";
import {
  Pagination as BPagination,
  PaginationItem,
  PaginationLink
} from "reactstrap";

class Pagination extends Component {

  constructor(props) {
    super(props);
    this.handleOnClick = this.handleOnClick.bind(this);
  }

  handleOnClick(page, e) {
    e.preventDefault();
    this.props.onChange(page);
  }

  isFirstPageVisible(has_previous_page) {
    const {hideDisabled, hideNavigation, hideFirstLastPages} = this.props;
    return !hideNavigation && !hideFirstLastPages && !(hideDisabled && !has_previous_page);
  }

  isPrevPageVisible(has_previous_page) {
    const {hideDisabled, hideNavigation} = this.props;
    return !hideNavigation && !(hideDisabled && !has_previous_page);
  }

  isNextPageVisible(has_next_page) {
    const {hideDisabled, hideNavigation} = this.props;
    return !hideNavigation && !(hideDisabled && !has_next_page);
  }

  isLastPageVisible(has_next_page) {
    const {hideDisabled, hideNavigation, hideFirstLastPages} = this.props;
    return !hideNavigation && !hideFirstLastPages && !(hideDisabled && !has_next_page);
  }

  buildPages() {
    const pages = [];
    const {
      itemsCountPerPage,
      pageRangeDisplayed,
      activePage,
      prevPageText,
      nextPageText,
      firstPageText,
      lastPageText,
      totalItemsCount,
      handleOnClick,
      itemClass,
      getPageUrl
    } = this.props;

    const paginationInfo = new Paginator(
      itemsCountPerPage,
      pageRangeDisplayed
    ).build(totalItemsCount, activePage);

    for (
      let i = paginationInfo.first_page;
      i <= paginationInfo.last_page;
      i++
    ) {
      pages.push(
        <PaginationItem
          active={i === activePage}
          className={itemClass}
          key={i}
          onClick={(e) => { this.handleOnClick(i, e) }}
        >
          <PaginationLink href={getPageUrl(i)}>
            {i + ""}
          </PaginationLink>
        </PaginationItem>
      );
    }

    this.isPrevPageVisible(paginationInfo.has_previous_page) &&
    pages.unshift(
      <PaginationItem
        className={itemClass}
        key={"prev" + paginationInfo.previous_page}
        onClick={(e) => { this.handleOnClick(paginationInfo.previous_page, e) }}
        disabled={!paginationInfo.has_previous_page}
      >
        <PaginationLink href={getPageUrl(paginationInfo.previous_page)}>
          {prevPageText}
        </PaginationLink>
      </PaginationItem>
    );

    this.isFirstPageVisible(paginationInfo.has_previous_page) &&
    pages.unshift(
      <PaginationItem
        className={itemClass}
        key={"first"}
        onClick={(e) => { this.handleOnClick(1, e) }}
        disabled={!paginationInfo.has_previous_page}
      >
        <PaginationLink href={getPageUrl(1)}>
          {firstPageText}
        </PaginationLink>
      </PaginationItem>
    );

    this.isNextPageVisible(paginationInfo.has_next_page) &&
    pages.push(
      <PaginationItem
        className={itemClass}
        key={"next" + paginationInfo.next_page}
        onClick={(e) => { this.handleOnClick(paginationInfo.next_page, e) }}
        disabled={!paginationInfo.has_next_page}
      >
        <PaginationLink href={getPageUrl(paginationInfo.next_page)}>
          {nextPageText}
        </PaginationLink>
      </PaginationItem>
    );

    this.isLastPageVisible(paginationInfo.has_next_page) &&
    pages.push(
      <PaginationItem
        className={itemClass}
        key={"last"}
        onClick={(e) => { this.handleOnClick(paginationInfo.total_pages, e) }}
        disabled={paginationInfo.current_page === paginationInfo.total_pages}
      >
        <PaginationLink href={getPageUrl(paginationInfo.total_pages)}>
          {lastPageText}
        </PaginationLink>
      </PaginationItem>
    );

    return pages;
  }

  render() {
    const pages = this.buildPages();
    return (
      <BPagination>
        {pages}
      </BPagination>
    );
  }
}

Pagination.propTypes = {
  totalItemsCount: PropTypes.number.isRequired,
  onChange: PropTypes.func.isRequired,
  activePage: PropTypes.number,
  itemsCountPerPage: PropTypes.number,
  pageRangeDisplayed: PropTypes.number,
  prevPageText: PropTypes.oneOfType([PropTypes.string, PropTypes.element]),
  nextPageText: PropTypes.oneOfType([PropTypes.string, PropTypes.element]),
  lastPageText: PropTypes.oneOfType([PropTypes.string, PropTypes.element]),
  firstPageText: PropTypes.oneOfType([PropTypes.string, PropTypes.element]),
  hideDisabled: PropTypes.bool,
  hideNavigation: PropTypes.bool,
  itemClass: PropTypes.string,
  hideFirstLastPages: PropTypes.bool,
  getPageUrl: PropTypes.func
};

Pagination.defaultProps = {
  itemsCountPerPage: 10,
  pageRangeDisplayed: 5,
  activePage: 1,
  prevPageText: "⟨",
  firstPageText: "«",
  nextPageText: "⟩",
  lastPageText: "»",
  itemClass: undefined,
  hideFirstLastPages: false,
  getPageUrl: (i) => "#"
};

export default Pagination;
