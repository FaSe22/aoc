package rowmapper

import (
	"testing"
)

func TestMapRow(t *testing.T) {
	res := MapRow()
	expected_res := 4

	if res != expected_res {
		t.Errorf("expected %d , got %d", expected_res, res)
	}
}
