
<script>
    const combination = (nums, k) => {
        let ans = [];
        if (nums.length < k) {
            return []
        }
        if (k === 1) {
            for (let i = 0; i < nums.length; i++) {
                ans[i] = [nums[i]];
            }
        } else {
            for (let i = 0; i < nums.length - k + 1; i++) {
                let row = combination(nums.slice(i + 1), k - 1);
                for (let j = 0; j < row.length; j++) {
                    ans.push([nums[i]].concat(row[j]));
                }
            }
        }
        return ans;
    }

    let arr = combination(['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j'], 4);
    let arrNum = arr.length;
    console.log(JSON.stringify(arr) + "\r\n" + arrNum);
</script>
