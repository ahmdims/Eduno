document.addEventListener("DOMContentLoaded", function () {
    const courseList = document.querySelectorAll(".course-item");
    const categoryFilters = document.querySelectorAll("#category-filters li");
    const searchInput = document.getElementById("searchInput");
    const courseIndex = document.getElementById("course-index");

    // Function update course count
    function updateCourseCount() {
        const visibleCourses = Array.from(courseList).filter(
            (course) => course.style.display !== "none"
        );
        courseIndex.textContent = `Showing ${visibleCourses.length} results`;
    }

    // Search by title
    searchInput.addEventListener("input", function () {
        const searchText = this.value.toLowerCase();

        // Filter courses by title
        courseList.forEach((course) => {
            const courseTitle = course.getAttribute("data-title");
            course.style.display = courseTitle
                .toLowerCase()
                .includes(searchText)
                ? ""
                : "none";
        });
        updateCourseCount();
    });

    // Filter Category
    categoryFilters.forEach((filter) => {
        filter.addEventListener("click", function () {
            const categoryId = this.getAttribute("data-category-id");

            // Deactive filter
            categoryFilters.forEach((f) => {
                f.classList.remove("active");
                f.querySelector("button").classList.remove("active");
            });

            // Active filter
            this.classList.add("active");
            this.querySelector("button").classList.add("active");

            courseList.forEach((course) => {
                const courseCategoryId =
                    course.getAttribute("data-category-id");
                course.style.display =
                    !categoryId || courseCategoryId === categoryId
                        ? ""
                        : "none";
            });

            updateCourseCount();
        });
    });

    updateCourseCount();
});
